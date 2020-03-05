<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_vk_action extends vyborypresidenta2014_controller
{
	public function execute()
	{
                
               
                $party_id = request::get('id');
                
                
                if (request::get('code')) {
               
                        $c = curl_init('https://oauth.vk.com/access_token?client_id=2953461&client_secret=HK3I9LqApVi6fTNoX6tK&code='.request::get('code'));
                        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                        
                        $access_json = curl_exec($c);
                        
                        $access_array=json_decode($access_json, true);

                        //если понадобится инфа о товарище https://api.vk.com/method/users.get?uids=$access_array['user_id']&access_token=$access_array['access_token']
                        // md5(app_id+user_id+secret_key);
                        
                            if ($access_array['user_id']>0) 
                            {
                                votes2014_peer::instance()->remove_vk_votes($access_array['user_id']);
                                votes2014_peer::instance()->insert(array(
                                    'president_id' => $party_id,
                                    'vkid' => $access_array['user_id'],
                                    'ts' => time(),
                                    'ua' => $_SERVER['HTTP_USER_AGENT'],
                                    'ip' => $_SERVER['REMOTE_ADDR']));
                            }
                        $this->redirect("https://vkontakte.ru/share.php?url=https://".context::get('server')."/vyborypresidenta2014/candidat?id=".$party_id);
                }
                else die('error');

        }
}