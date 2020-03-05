<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_facebook_action extends vyborypresidenta2014_controller
{
	public function execute()
	{
                
                //load::action_helper('facebook',false);
                load::lib('auth/lib/facebook/facebook');
                $facebook = new facebook_auth(array(
                      'appId'  => '133922360065517',
                      'secret' => 'c3b2fcda6574d9fff849c651e7d57383',
                    ));
                
                $party_id = request::get('id');
                // Get User ID
                if (request::get('code') && request::get('state')) $fb_id = $facebook->getUser();

                if ($fb_id) {
                        // Proceed knowing you have a logged in user who's authenticated.
                        $data = $facebook->api('/me');
                        
                        if ($data['birthday']) $age=floor((time()-strtotime($data['birthday']))/(365*24*60*60));
                        $user_data = array(
                                'first_name' => $data['first_name'],
                                'last_name' => $data['last_name'],
                                'gender' => $data['gender'][0],
                                'political_views_custom' => $data['political'],
                                'bio' => ($data['bio'] ? $data['bio'] : '') ,
                                'interests' => ($data['interested_in'] ? $data['interested_in'] : ''),
                                'fbid' => $fb_id
                        );
                        if (!$user = user_auth_peer::instance()->get_by_email($data['email'])) $user = db::get_row('SELECT * FROM user_auth WHERE id in (SELECT user_id FROM user_data WHERE fbid  = :fbid LIMIT 1)', array('fbid' => strtolower($fb_id)));
                        if ( !$user)
                        {
                             $password=substr(md5(microtime(true)), 0, 8);
                    
                                $id = user_auth_peer::instance()->insert(
                                        $data['email'],
                                        $password,
                                        user_auth_peer::TYPE_PERSON
                                );
                                $user = user_auth_peer::instance()->get_item($id);
                                
                                $user_data['user_id']=$id;
                                load::model('user/user_data');
                                user_data_peer::instance()->insert($user_data);

                                load::system('email/email');

                                $email = new email();
                                $email->setReceiver($data['email']);

                                $body =$data['first_name'] . ', ' . t('добро пожаловать на') . ' Politiko!' . "\n" .
                                t('Вы приняли участие в онлайн голосовании, и Вам необходимо подтвердить свой голос.') .
                                "\n" .
                                "\n" .
                                t('Для подтверждения нажмите на ссылку ниже: ') . "\n" .
                                'https://' . context::get('server') . '/sign/activate?c=' . $user['security_code'] . "\n" .
                                "\n" .
                                t('Ваши данные для входа:') .
                                "\n" .
                                t('Логин') . ' ' . $data['email'] . 
                                "\n" .
                                t('Пароль') . ' ' . $password . 
                                "\n" .
                                "\n".
                                'Politiko.ua';

                                $email->setBody($body);
                                $email->setSubject( t('Подтверждение голоса на') . ' Politiko.ua');
                                $email->send();
                        }
                        else {
                            //update profile code
                        }
                        
                        //if ( request::get('vote') )
                        //{
                            if ($user['id']>0)
                            {
                                votes2014_peer::instance()->remove_votes($user['id']);
                                votes2014_peer::instance()->insert(array(
                                    'president_id' => $party_id,
                                    'user_id' => $user['id'],
                                    'ts' => time(),
                                    'ua' => $_SERVER['HTTP_USER_AGENT'],
                                    'ip' => $_SERVER['REMOTE_ADDR']));
                            }

                        //}
                        $this->redirect('https://www.facebook.com/sharer.php?u=https://'.context::get('server').'/vyborypresidenta2014/candidat?id='.$party_id);

                }
                $login_url=$facebook->getLoginUrl(array('scope'=>array('email','user_interests','user_about_me','user_birthday','user_religion_politics')));
                $this->redirect($login_url);



        }
}