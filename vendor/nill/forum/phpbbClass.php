<?php

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
