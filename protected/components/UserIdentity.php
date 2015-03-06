<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const ERROR_ACCOUNT_BLOCKED = 3;
    const ERROR_ACCOUNT_DELETED = 4;

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = Users::model()->find('user_email = :U', array(':U' => $this->username));


        if ($user === null):
            $this->errorCode = self::ERROR_USERNAME_INVALID;

        elseif ($user->user_status == 0):
            $this->errorCode = self::ERROR_ACCOUNT_BLOCKED;
        else:
            $is_correct_password = ($user->user_password !== Myclass::encrypt($this->password)) ? false : true;

            if ($is_correct_password):
                $this->errorCode = self::ERROR_NONE;
            else:
                $this->errorCode = self::ERROR_USERNAME_INVALID;   // Error Code : 1
            endif;
        endif;

        if ($this->errorCode == self::ERROR_NONE):
            $this->setUserData($user);
        endif;

        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    public function autoLogin() {
        $user = Users::model()->find('user_email = :U', array(':U' => $this->username));
        if ($user === null):
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else:
            $this->setUserData($user);
        endif;
        return !$this->errorCode;
    }

    protected function setUserData($user) {
        $this->_id = $user->user_id;
        $this->setState('user_email', $user->user_email);
        $this->setState('user_name', $user->user_name);
        $user->user_last_login = date('Y-m-d H:i:s');
        $user->user_login_ip = Yii::app()->request->userHostAddress;
        $user->save(false);
        return;
    }

}
