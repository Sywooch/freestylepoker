Integration
============

Part 1: Create phpBB class
--------------------------

- Add folder `/vendor/nill/forum/`

- Create PhpBBWebUser.php 
> This class extended Users model

```
namespace nill\forum;

use Yii;
use yii\web\User;
use yii\web\IdentityInterface;
use yii\base\InvalidParamException;

class PhpBBWebUser extends User {

    /** @var UserIdentity */
    private $_identity;

    public function login(IdentityInterface $identity, $duration = 0) {
        $this->_identity = $identity;
        return parent::login($identity, $duration);
    }

    protected function afterLogin($identity, $fromCookie, $duration) {
        if ($this->_identity !== null) {
            if (\Yii::$app->phpBB->login($this->_identity->username, $this->_identity->password_reg) != 'SUCCESS') {
                throw new InvalidParamException('Не удалось пройти авторизацию на форуме');
            }
        }
        parent::afterLogin($identity, $fromCookie, $duration);
    }

    protected function afterLogout($identity) {
        \Yii::$app->phpBB->logout();
        parent::afterLogout($identity);
    }

}
  ``` 

- Create PhpBB.php 
> This component yii2 for integration to phpbb 3.1.x

```
/**
 * component to work with phpBB forum users
 *
 * @author Mefistophell Nill <https://github.com/Mefistophell>
 *
 * @version 0.2
 *
 * @category yii2-extensions
 * 
 * This component can:
 * login
 * logout
 * user_add
 * user_delete
 * change_password
 * user_update
 * loggedin
 *
 * In config in section components:
 * 		...
 *              'phpBB' => [
 *                  'class' => 'nill\forum\phpBB',
 *                  'path' => dirname(dirname(__DIR__)). '\forum',
  ],
 * 		...
 *
 * Using:
 * Yii::app()->phpBB->login($user->phpBBLogin,$this->password);
 * ...
 *
 */

namespace nill\forum;

use Yii;
use nill\forum\phpbbClass;
use yii\base\Component;

class phpBB extends Component {

    /**
     * Path to forum
     * @var string
     */
    public $path = '/forum';

    /**
     * PHP file extentions
     * @var string
     */
    public $php = 'php';

    /**
     * phpBB user data table
     * @var string
     */
    public $user_table = 'frm_users';
    protected $_phpbb;

    public function init() {
        if (!$this->path) {
            throw new CException("Не указан путь к форуму");
        }
//		Yii::import($this->path . '.includes.utf.utf_normalizer');
        $this->_phpbb = new phpbbClass($this->path . DIRECTORY_SEPARATOR, $this->php);
    }

    /**
     * Login in phpBB
     * @param string $username
     * @param string $password
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function login($username, $password) {
        return $this->_phpbb->user_login(array(
                    "username" => $username,
                    "password" => $password,
        ));
    }

    /**
     * Logout in phpBB
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function logout() {
        return $this->_phpbb->user_logout();
    }

    /**
     * Add user to phpBB
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int $group_id
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function userAdd($username, $password, $email, $group_id = 2) {
        return $this->_phpbb->user_add(array(
                    "username" => $username,
                    "user_password" => $password,
                    "user_email" => $email,
                    "group_id" => $group_id,
//			"user_lang"=>Yii::app()->language,
        ));
    }

    /**
     * Delete phpBB user
     * @param mixed $user integer userid or string username
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function userDelete($user) {
        $phpbb_vars = is_int($user) ? array("user_id" => $user) : array("username" => $user);

        return $this->_phpbb->user_delete($phpbb_vars);
    }

    /**
     * Change user password
     * @param mixed $user integer userid or string username
     * @param string $password new password
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function changePassword($user, $password) {
        $phpbb_vars = is_int($user) ? array("user_id" => $user) : array("username" => $user);

        $phpbb_vars['password'] = $password;

        return $this->_phpbb->user_change_password($phpbb_vars);
    }

    public function changeEmail($user, $email) {
        $phpbb_vars = is_int($user) ? array("user_id" => $user) : array("username" => $user);

        $phpbb_vars['email'] = $email;

        return $this->_phpbb->user_change_email($phpbb_vars);
    }

    /**
     * Test if user is logged in phpBB
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function loggedin() {
        return $this->_phpbb->user_loggedin();
    }

    /**
     * Update user information
     * @param array $$phpbb_vars $user_row = array(
     * 			"username",
     * 			"user_password",
     * 			"user_email",
     * 			"group_id",
     * 			"user_timezone",
     * 			"user_dst",
     * 			"user_lang",
     * 			"user_type",
     * 			"user_actkey",
     * 			"user_dateformat",
     * 			"user_style",
     * 			"user_regdate",
     * 			"user_colour",
     * 		);
     * @return string 'FAIL' or 'SUCCESS'
     */
    public function user_update($phpbb_vars) {
        return $this->_phpbb->user_update($phpbb_vars);
    }

}
```
- Create phpbbClass.php 
> This 2 Classes for integration phpBB

```
namespace nill\forum;

/*
  PHPBB Forum manipulation Class
  By Felix Manea (felix.manea@gmail.com)
  www.ever.ro
  Licensed under LGPL
  NOTE: You are required to leave this header intact.
 */

class dbr extends \phpbb\auth\provider\base {

    /**
     * Database Authentication Constructor
     *
     * @param    phpbb_db_driver    $db
     */
    public function __construct(\phpbb\db\driver\driver_interface $db) {
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public function login($username, $password) {
        // Auth plugins get the password untrimmed.
        // For compatibility we trim() here.
        $password = trim($password);

        // do not allow empty password
        if (!$password) {
            return array(
                'status' => LOGIN_ERROR_PASSWORD,
                'error_msg' => 'NO_PASSWORD_SUPPLIED',
                'user_row' => array('user_id' => ANONYMOUS),
            );
        }

        if (!$username) {
            return array(
                'status' => LOGIN_ERROR_USERNAME,
                'error_msg' => 'LOGIN_ERROR_USERNAME',
                'user_row' => array('user_id' => ANONYMOUS),
            );
        }

        //$username_clean = utf8_clean_string($username);
        $username_clean = $username;

        $sql = 'SELECT user_id, username, user_password, user_passchg, user_email, user_type, user_login_attempts
            FROM ' . USERS_TABLE . "
            WHERE username_clean = '" . $this->db->sql_escape($username_clean) . "'";
        $result = $this->db->sql_query($sql);
        $row = $this->db->sql_fetchrow($result);
        $this->db->sql_freeresult($result);

        // Successful login... set user_login_attempts to zero...
        return array(
            'status' => LOGIN_SUCCESS,
            'error_msg' => false,
            'user_row' => $row,
        );
    }

}

class phpbbClass {

    //various table fields
    var $table_fields = array();
    public $dire;

    //constructor
    public function __construct($path, $php_extension = "php") {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        define('IN_PHPBB', true);
        $phpbb_root_path = $path;
        $phpEx = $php_extension;
        $this->dire = "x";
        $dire = "xx";
    }

    //initialize phpbb
    function init($prepare_for_login = false) {
        global $dire, $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $phpbb_dispatcher, $cache, $template, $request, $phpbb_container, $symfony_request, $phpbb_filesystem;
        if ($prepare_for_login && !defined("IN_LOGIN"))
            define("IN_LOGIN", true);
        require_once($phpbb_root_path . 'common.' . $phpEx);
        //include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
        //session management
        $request->enable_super_globals();
        $user->session_begin();
//		$auth->acl($user->data);
//                $this->bbauth = new phpbb_ext_imkingdavid_authext_auth_provider_db2($db);
//                
    }

    //user_login
    public function user_login($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template, $_SID;
        //fail presumption
        $phpbb_result = "FAIL";

        //general info
        $this->init(true);

//                $dbr=new dbr($db);
//                $dbr->login($phpbb_vars["username"], $phpbb_vars["password"]);

        if (!isset($phpbb_vars["autologin"]))
            $phpbb_vars["autologin"] = false;
        if (!isset($phpbb_vars["viewonline"]))
            $phpbb_vars["viewonline"] = 1;
        if (!isset($phpbb_vars["admin"]))
            $phpbb_vars["admin"] = 0;

        //validate and authenticate
        //$validation = login_db($phpbb_vars["username"], $phpbb_vars["password"]);
        $dbr = new dbr($db);
        $validation = $dbr->login($phpbb_vars["username"], $phpbb_vars["password"]);
        if ($validation['status'] == 3 && $auth->login($phpbb_vars["username"], $phpbb_vars["password"], $phpbb_vars["autologin"], $phpbb_vars["viewonline"], $phpbb_vars["admin"]))
            $phpbb_result = "SUCCESS";

        //login issue noticed by Ezequiel Rabinovich (thanks)
        $_SESSION['sid'] = $_SID;

        return $phpbb_result;
    }

    //user_logout
    public function user_logout() {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;

        //fail presumption
        $phpbb_result = "FAIL";

        //general info
        $this->init(true);

        //session management
        $user->session_begin();
        $auth->acl($user->data);

        //destroy session if needed
        if ($user->data['user_id'] != ANONYMOUS) {
            $user->session_kill();
            $user->session_begin();
            $phpbb_result = "SUCCESS";
        }

        return $phpbb_result;
    }

    //user_loggedin
    function user_loggedin() {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        //fail presumtion
        $phpbb_result = "FAIL";

        //general info
        $this->init(false);

        //session management
        $user->session_begin();

        //anonymous fix by John Issac (thanks)
        if (is_array($user->data) && isset($user->data["user_id"]) && $user->data["user_id"] != ANONYMOUS && $user->data["user_id"] > 0)
            $phpbb_result = "SUCCESS";

        return $phpbb_result;
    }

    //user_add
    public function user_add($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template, $phpbb_dispatcher;
        //fail presumtion
        $phpbb_result = "FAIL";

        //if the mandatory parameters are not given fail
        if (trim(@$phpbb_vars['username']) == '' || !isset($phpbb_vars['group_id']) || !isset($phpbb_vars['user_email']))
            return $phpbb_result;

        //general info
        $this->init(false);

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        //default user info
        $user_row = array(
            "username" => $phpbb_vars["username"],
            "user_password" => phpbb_hash($phpbb_vars["user_password"]),
            "user_email" => $phpbb_vars["user_email"],
            "group_id" => !isset($phpbb_vars["group_id"]) ? "2" : $phpbb_vars["group_id"],
            "user_timezone" => "2.00",
            //"user_dst" => 0,
            //"user_lang" => $phpbb_vars["user_lang"],
            "user_type" => !isset($phpbb_vars["user_type"]) ? "0" : $phpbb_vars["user_type"],
            "user_actkey" => "",
            "user_dateformat" => "D M d, Y g:i a",
            "user_style" => "1",
            "user_regdate" => time(),
            "user_colour" => "9E8DA7",
        );

        //replace default values with the ones in phpbb_vars array (not yet tested / implemented)
        //foreach($user_row as $key => $value) if(isset($phpbb_vars[$key])) $user_row[$key] = $phpbb_vars[$key];
        //register user
        if ($phpbb_user_id = user_add($user_row))
            $phpbb_result = "SUCCESS";

        //update the rest of the fields
        $this->user_update($phpbb_vars);

        return $phpbb_result;
    }

    //user_delete
    public function user_delete($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        //fail presumtion
        $phpbb_result = "FAIL";

        //general info
        $this->init(false);

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        //get user_id if possible
        if (!isset($phpbb_vars["user_id"]))
            if (!$phpbb_vars["user_id"] = $this->get_user_id_from_name($phpbb_vars["username"]))
                return $phpbb_result;

        //delete user (always returns false)
        user_delete("remove", $phpbb_vars["user_id"]);
        $phpbb_result = "SUCCESS";

        return $phpbb_result;
    }

    //user_update
    public function user_update($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        //fail presumtion
        $phpbb_result = "FAIL";

        //general info
        $this->init(false);

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        //get user_id if possible
        if (!isset($phpbb_vars["user_id"]))
            if (!$phpbb_vars["user_id"] = $this->get_user_id_from_name($phpbb_vars["username"]))
                return $phpbb_result;


        $this->get_table_fields(USERS_TABLE);
        $ignore_fields = array("username", "user_id");

        if (isset($phpbb_vars["user_password"]))
            $phpbb_vars["user_password"] = phpbb_hash($phpbb_vars["user_password"]);
        if (isset($phpbb_vars["user_newpasswd"]))
            $phpbb_vars["user_newpasswd"] = phpbb_hash($phpbb_vars["user_newpasswd"]);
        $sql = "";
        //generate sql
        for ($i = 0; $i < count($this->table_fields[USERS_TABLE]); $i++)
            if (isset($phpbb_vars[$this->table_fields[USERS_TABLE][$i]]) && !in_array($this->table_fields[USERS_TABLE][$i], $ignore_fields))
                $sql .= ", " . $this->table_fields[USERS_TABLE][$i] . " = '" . $db->sql_escape($phpbb_vars[$this->table_fields[USERS_TABLE][$i]]) . "'";

        if (strlen($sql) != 0) {
            $db->sql_query("UPDATE " . USERS_TABLE . " SET " . substr($sql, 2) . " WHERE user_id = '" . $phpbb_vars["user_id"] . "'");
            $phpbb_result = "SUCCESS";
        }

        return $phpbb_result;
    }

    //user_change_password
    public function user_change_password($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        //fail presumtion
        $phpbb_result = "FAIL";

        //general info
        $this->init(false);

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        //get user_id if possible
        if (!isset($phpbb_vars["user_id"]))
            if (!$phpbb_vars["user_id"] = $this->get_user_id_from_name($phpbb_vars["username"]))
                return $phpbb_result;

        $db->sql_query("UPDATE " . USERS_TABLE . " SET user_password = '" . phpbb_hash($phpbb_vars["password"]) . "' WHERE user_id = '" . $phpbb_vars["user_id"] . "'");
        $phpbb_result = "SUCCESS";

        return $phpbb_result;
    }

    public function user_change_email($phpbb_vars) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;
        //fail presumtion
        $phpbb_result = "FAIL";

        //general info
        $this->init(false);

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        //get user_id if possible
        if (!isset($phpbb_vars["user_id"])) {
            if (!$phpbb_vars["user_id"] = $this->get_user_id_from_name($phpbb_vars["username"])) {
                return $phpbb_result;
            }
        } else {
            echo 'x';
        }

        $db->sql_query("UPDATE " . USERS_TABLE . " SET user_email = '" . $phpbb_vars["email"] . "' WHERE user_id = '" . $phpbb_vars["user_id"] . "'");
        $phpbb_result = "SUCCESS";

        return $phpbb_result;
    }

    private function get_table_fields($table) {
        //if already got table fields once
        if (isset($this->table_fields[$table]))
            return true;

        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;

        //general info
        $this->init(false);

        //get table fields
        $this->table_fields[$table] = array();
        if (!$result = $db->sql_query("SHOW FIELDS FROM " . $table))
            return false;
        while ($row = $db->sql_fetchrow($result))
            $this->table_fields[$table][] = $row["Field"];
        $db->sql_freeresult($result);

        return true;
    }

    //get user id if we know username
    public function get_user_id_from_name($username) {
        global $phpbb_root_path, $phpEx, $db, $config, $user, $auth, $cache, $template;

        //user functions
        require_once($phpbb_root_path . "includes/functions_user." . $phpEx);

        $user_id = false;
        if (!isset($username))
            return false;
        user_get_id_name($user_id, $username);
        if (!isset($user_id[0]))
            return false;
        return $user_id[0];
    }

}
```

- Create phpbb_session_handler.php
 
```
if(!defined('IN_PHPBB')) define('IN_PHPBB', true);
$phpbb_root_path = "path/to/forum";//absoulute physical path of the phpbb 3 forum
$phpEx = "php";//phpbb used extensions
require_once($phpbb_root_path."common.".$phpEx);
// Start session management
$user->session_begin();
// End session management
```

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

Part 2: Change User model
--------------------------

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

Part 2: Change forum settings
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
