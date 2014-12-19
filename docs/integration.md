Integration
============

Part 1: Create phpBB class
--------------------------

- Add folder `/vendor/nill/forum/`

- Download and unpack files to it directory
[Github: yii2-integration-phpBB3.1](https://github.com/8sun/yii2-integration-phpBB3.1)

Part 2: Add component and setting config
----------------------------------------

- Add component to config `/common/congig/main.php`:

```
        'phpBB' => [
            'class' => 'nill\forum\phpBB',
            'path' => dirname(dirname(__DIR__)). '\forum',
        ],
```

- Add to extensions `/vendor/yiisoft/extensions.php`:

```
'nill/forum' => 
    array (
        'name' => 'nill/forum',
        'version' => '0.1.0.0',
        'alias' => 
        array (
            '@nill/forum' => $vendorDir . '/nill/forum',
        ),
    ),
```

- Add `request` and change `user` to components:

```
        'user' => [
            'class' => 'nill\forum\PhpBBWebUser',
            'loginUrl'=>['/login'],
            'identityClass' => 'vova07\users\models\frontend\User',
            // enable cookie-based authentication
            // 'allowAutoLogin' => true,
        ],
        'request' => [
            'baseUrl' => $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'] != $_SERVER['SCRIPT_FILENAME'] ? 'http://' . $_SERVER['HTTP_HOST'] : '',
        ],
```

Part 3: Change User Model
----------------------------------------

- Add behaviors `\vendor\vova07\yii2-start-users-module\behaviors` PhpBBUserBahavior.php:

```
namespace vova07\users\behaviors;

use yii\log\Logger;
use yii\db\ActiveRecord;

/**
 * Поведение расширяющее модель User
 * Используется для изменений данных от пользователя,
 * а так же для сквозной регистрации
 */
class PhpBBUserBahavior extends \yii\base\Behavior {

    public $userAttr = 'username';
    public $newpassAttr = 'password_new';
    public $passAttr = 'password';
    public $emailAttr = 'email';

    /**
     * EVENT_BEFORE_INSERT и EVENT_BEFORE_UPDATE
     * возможно лучше заменить на EVENT_AFTER_VALIDATE
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'confirm',
            ActiveRecord::EVENT_BEFORE_INSERT => 'confirm',
        ];
    }

    private $_isNew;

    public function beforeSave($event) {
        $this->_isNew = $this->owner->isNew;
    }

    public function afterSave($event) {
        // Разные способы получить нужные атрибуты прямо из модели
        //$user=$this->owner->getAttributes(['username']);
        //$password=$this->owner->password_new;
        //$email=$this->owner->email;
        if ($this->owner->act == false) {
            if ($this->owner->{$this->passAttr}) {
                if ($this->owner->isNew) {
                    \Yii::$app->phpBB->userAdd($this->owner->{$this->userAttr}, $this->owner->{$this->passAttr}, $this->owner->{$this->emailAttr}, 2);
                }
            } else if ($this->owner->{$this->newpassAttr}) {
                if (!$this->owner->isNew) {
                    \Yii::$app->phpBB->changePassword($this->owner->{$this->userAttr}, $this->owner->{$this->newpassAttr});
                }
            }
            // Возможно следует пренести сюда confirm()
            else if ($this->owner->{$this->emailAttr}) {
                \Yii::trace($this->owner->{$this->emailAttr}, 'X__EMAIL');
            }
        }
    }

    /**
     * Это метод подтверждения e-mail
     * В случае успешной проверки e-mail изменяется и на форуме
     */
    public function confirm() {
        if ($this->owner->{$this->emailAttr}) {
            \Yii::$app->phpBB->changeEmail($this->owner->{$this->userAttr}, $this->owner->{$this->emailAttr});
        }
    }

    /**
     * Пользователи не могут удалять свои аккауны с сайта и форума
     * Но это можно сделать из админ-панели
     * Следует перенести этот метод в backend
     */
    public function afterDelete($event) {
        Yii::$app->phpBB->userDelete($this->owner->{$this->userAttr});
    }

}
```

- Add this code in begin User class:

`use vova07\users\behaviors\PhpBBUserBahavior;`

and

```
    /**
     * Переменные необходимые для интеграции с форумом
     * @var string $password_reg - старый пароль (при смене пароля пользователем)
     * @var string $password_new - новый пароль
     */
    public $password_reg;
    public $password_new;
```

- Add or change this code before method `getId`

```
    /**
     * Поведение PhpBBUserBahavior необходимо для интеграции с форумом
     */
    public function behaviors() {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
            'PhpBBUserBahavior' => [
                'class' => PhpBBUserBahavior::className(),
                'userAttr' => 'username',
                'newpassAttr' => 'password_new',
                'passAttr' => 'password',
                'emailAttr' => 'email',
            ],
        ];
    }
```

- Change next methods: 

```
    public function validatePassword($password) {
        // Костыль для получения пароля в чистом виде (не хэшированный) 
        $this->password_reg = $password;

        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
```

and

```
    public function password($password) {
        // Костыль для получения пароля в чистом виде (не хэшированный) 
        $this->password_new = $password;

        $this->setPassword($password);
        return $this->save(false);
    }
```

- Comment `\vendor\vova07\yii2-start-users-module\models\frontend\User.php`
in method `afterSave`:

```
//$auth->assign($role, $this->id);
```

Part 4: Change forum settings
--------------------------

- Change method `get_container_filename()` in `\forum\phpbb\di\container_builder.php`

```
    protected function get_container_filename() {

        // Изменена строка для синхронизации с сайтом
        // $filename = str_replace(array('/', '.'), array('slash', 'dot'), $this->phpbb_root_path);

        $filename = str_replace(array('\\', '/', '.'), array('slash', 'slash', 'dot'), $this->phpbb_root_path);
        return $this->phpbb_root_path . 'cache/container_' . $filename . '.' . $this->php_ext;
    }
```

- Change `frm_config` field `cookie_domain` on your domain: 
***example*** - `domain.loc`
