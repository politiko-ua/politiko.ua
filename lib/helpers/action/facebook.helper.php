<?
load::lib('auth/lib/facebook/facebook');

class facebook_helper
{
        public $facebook;
        function init() {
            $facebook = new facebook_auth(array(
                      'appId'  => '133922360065517',
                      'secret' => 'c3b2fcda6574d9fff849c651e7d57383',
                    ));
            return $facebook;
        }
                
        public static function loginurl()
        {
                $facebook=self::init();
                return $facebook->getLoginUrl(array('scope'=>array('email','user_interests','user_about_me','user_birthday','user_religion_politics')));
        }
                
        public static function user_data()
        {
                $facebook=self::init();
                return $facebook->api('/me');
        }
        public static function get_fbid()
        {
                $facebook=self::init();
                return $facebook->getUser();
	}
}