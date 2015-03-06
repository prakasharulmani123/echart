<?php

class HybridAuthIdentity extends CUserIdentity {

    const VERSION = '2.1.2';

    /**
     *
     * @var Hybrid_Auth
     */
    public $hybridAuth;

    /**
     *
     * @var Hybrid_Provider_Adapter
     */
    public $adapter;

    /**
     *
     * @var Hybrid_User_Profile
     */
    public $userProfile;
    public $allowedProviders = array('google', 'facebook', 'linkedin', 'yahoo', 'live', 'twitter');
    protected $config;

    function __construct() {
        $path = Yii::getPathOfAlias('ext.HybridAuth');
        require_once $path . '/hybridauth-' . self::VERSION . '/hybridauth/Hybrid/Auth.php';  //path to the Auth php file within HybridAuth folder

        $this->config = array(
            "base_url" => Yii::app()->createAbsoluteUrl("/site/users/sociallogin"),
            "providers" => array(
                "Google" => array(
                    "enabled" => true,
                    "keys" => array(
//                        "id" => "49305767216-ljvhl2k8qpjl15b0n4hqvhml3c5pa92j.apps.googleusercontent.com",
//                        "secret" => "TKEXtxHv4MKXXvFkvW9istdA",
                        "id" => GOOGLE_APP_ID,
                        "secret" => GOOGLE_SECRET_ID
                    ),
                    "scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email",
                    "access_type" => "online",
                ),
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array(
//                        "id" => "1043105999049965",
//                        "secret" => "a9e6a8156bd58b152a76d554896117f5",
                        "id" => FB_APP_ID,
                        "secret" => FB_SECRET_ID
                    ),
                    "scope" => "email",
                    "display" => "popup"
                ),
                "Live" => array(
                    "enabled" => true,
                    "keys" => array(
                        "id" => "windows client id",
                        "secret" => "Windows Live secret",
                    ),
                    "scope" => "email"
                ),
                "Yahoo" => array(
                    "enabled" => true,
                    "keys" => array(
                        "key" => "yahoo client id",
                        "secret" => "yahoo secret",
                    ),
                ),
                "LinkedIn" => array(
                    "enabled" => true,
                    "keys" => array(
                        "key" => "75ceofjehdfs7j",
                        "secret" => "QfLa8xh0hnlvq81g",
                    ),
                ),
                "Twitter" => array(
                    "enabled" => true,
                    "keys" => array(
                        "key" => "xpee301A4Sohk0uvZjgyn30Kc",
                        "secret" => "aisllYXMlL2xI4y2VOs5nm5eXcJyXIdkjb1b4lSFyg59ptPbZu"
                    )
                )
            ),
            "debug_mode" => false,
            // to enable logging, set 'debug_mode' to true, then provide here a path of a writable file
            "debug_file" => "",
        );

        $this->hybridAuth = new Hybrid_Auth($this->config);
    }

    /**
     *
     * @param string $provider
     * @return bool
     */
    public function validateProviderName($provider) {
        if (!is_string($provider))
            return false;
        if (!in_array($provider, $this->allowedProviders))
            return false;

        return true;
    }

    public function processLogin() {
        if (!empty($this->userProfile)) {
            $newrecord = false;
            $model = Users::model()->find("user_email = '{$this->userProfile->email}'");

            if (is_null($model)):
                $newrecord = true;
                $model = new Users('social_register');
            endif;

            $result = $this->registerNewUser($model, $newrecord);
            $identity = new UserIdentity($result->user_email, 'anonyms');
            $identity->autoLogin();
            Yii::app()->user->login($identity);

//            $model = new LoginForm('login');
//            $log = array('username' => $result->user_email, 'password' => $result->user_password);
//            $model->attributes = $log;
//            $model->login();
//            $identity->autoLogin();
//            Yii::app()->user->login($identity,0);
        }
    }

    public function registerNewUser($model, $newrecord) {
        if ($newrecord):
            $model->user_name = $this->userProfile->firstName;
            $model->user_email = $this->userProfile->email;
            $password = Myclass::getRandomString('8');
            $model->user_password = $password;
            $model->user_status = 1;
        else:
            $model->user_status = 1;
            $model->user_last_login = date('Y-m-d h:i:s');
        endif;

//        if (!empty($this->userProfile->photoURL) && ($newrecord || empty($patient->profile_picture))):
//            if ($image = $patient->urlImageSave($this->userProfile->photoURL, rand()))
//                $model->user_avatar = $image;
//        endif;
//        if (empty($patient->first_name))
//            $patient->first_name = $this->userProfile->firstName;
//        if (empty($patient->last_name))
//            $patient->last_name = $this->userProfile->lastName;
//        if (empty($patient->street))
//            $patient->street = $this->userProfile->address;
//        if (empty($patient->state)):
//            $state = States::model()->find("stateName = '{$this->userProfile->region}'");
//            if (!empty($state))
//                $patient->state = $state->stateID;
//        endif;
//        if (empty($patient->city)):
//            $city = Cities::model()->find("cityName = '{$this->userProfile->city}'");
//            if (!empty($city))
//                $patient->city = $city->cityID;
//        endif;
//
//        if (empty($patient->zipcode))
//            $patient->zipcode = $this->userProfile->zip;
//        if (empty($model->mobile_number))
//            $model->mobile_number = $this->userProfile->phone;

        if ($model->validate()) {
            $model->save(false);

//            if ($newrecord):
//                JobuserController::registrationMail($model, $patient);
//            endif;

            return $model;
        } else {
            echo CHtml::errorSummary($model);
            exit;
        }
    }

}
