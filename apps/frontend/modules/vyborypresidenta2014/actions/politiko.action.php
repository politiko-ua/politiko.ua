<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_politiko_action extends vyborypresidenta2014_controller
{
	public function execute()
	{

                if(session::get_user_id()>0 && request::get_int('id')) {
                        votes2014_peer::instance()->remove_votes(session::get_user_id());
                        
                        votes2014_peer::instance()->insert(array(
                                'president_id' => request::get_int('id'),
                                'user_id' => session::get_user_id(),
                                'ts' => time(),
                                'ua' => $_SERVER['HTTP_USER_AGENT'],
                                'ip' => $_SERVER['REMOTE_ADDR']));
                }  
                die();//else $this->redirect('/sign/up');
        }
}
