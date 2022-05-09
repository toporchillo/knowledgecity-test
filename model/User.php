<?php
namespace MODEL;

class User {
    private $DB;

    public function __construct() {
        $this->DB = new \DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    }

    public function checkToken($token) {
        if (!$token) {
            return false;
        }
        $res = $this->DB->query("SELECT u.id, u.login, t.token, t.ts FROM api_users u LEFT JOIN user_tokens t ON u.id=t.user_id WHERE t.token='".$this->DB->escape($token)."'");

        if (!$res->num_rows) {
            return false;
        }
        $row = $res->row;
        if (time() > ($row['ts'] + TOKEN_LIFETIME)) {
            $this->logout($token);
            return false;
        }
        return $row;
    }

    public function logout($token) {
        $res = $this->DB->query("DELETE FROM user_tokens WHERE token='".$this->DB->escape($token)."'");
    }

    public function login($login, $password) {
        if (empty($login) || empty($password)) {
            return false;
        }
        $hash = sha1($password.PASSWORD_HASH_SALT);
        $res = $this->DB->query("SELECT id, login FROM api_users WHERE login='".$this->DB->escape($login)."' AND password='".$this->DB->escape($hash)."'");
        if (!$res->num_rows) {
            return false;
        }
        $user = $res->row;
        $ts = time();
        $user['token'] = $this->createToken($user['id'], $ts);
        $user['ts'] = $ts;
        //Drop expired authorization tokens. In case of many-many users it's better to call this method by CRON.
        $this->cleanTokens();
        return $user;
    }

    private function createToken($user_id, $ts) {
        $token = sha1(uniqid());
        $this->DB->query("INSERT INTO user_tokens SET user_id='".intval($user_id)."', token='".$this->DB->escape($token)."', ts='".intval($ts)."'");
        //I know about NOW(), UTC_TIMESTAMP(),... SQL function, but Timezone difference between PHP and MySQL sometimes causes a bug.
        return $token;
    }

    private function cleanTokens() {
        $ts = time() - TOKEN_LIFETIME;
        $res = $this->DB->query("DELETE FROM user_tokens WHERE ts<'".intval($ts)."'");
    }
}