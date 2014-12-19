Users module
============

####Change User Model

- Add behaviors `\vendor\nill\users\behaviors` PhpBBUserBahavior.php:

```
namespace vova07\users\behaviors;

use yii\db\ActiveRecord;

/**
 * Поведение расширяющее модель User
 * Используется для изменений данных от пользователя,
 * а так же для сквозной регистрации в phpBB 3.1.x
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
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'confirm',
        ];
    }

    /**
     * Это метот регистрации новых пользователей
     */
    public function afterInsert($event) {
        \Yii::$app->phpBB->userAdd($this->owner->{$this->userAttr}, $this->owner->{$this->passAttr}, $this->owner->{$this->emailAttr}, 2);
    }

    /**
     * Это метод для смены пароля
     */
    public function afterUpdate($event) {
        if ($this->owner->{$this->newpassAttr}) {
            \Yii::$app->phpBB->changePassword($this->owner->{$this->userAttr}, $this->owner->{$this->newpassAttr});
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

- Add this code to the top User class:

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

- Comment or delete in `\vendor\nill\users\models\frontend\PasswordForm.php`
- Comment or delete in `\vendor\nill\users\models\frontend\Email.php`

this string

```
use nill\users\models\User;
```