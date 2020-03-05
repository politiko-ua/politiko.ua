<?

load::app('modules/vybory2012/controller');
class vybory2012_politiko_action extends vybory2012_controller
{
	public function execute()
	{

                if(session::get_user_id()>0 && request::get_int('id')) {
                        votes2012_peer::instance()->remove_votes(session::get_user_id());
                        
                        votes2012_peer::instance()->insert(array(
                                'party_id' => request::get_int('id'),
                                'user_id' => session::get_user_id(),
                                'ts' => time(),
                                'ua' => $_SERVER['HTTP_USER_AGENT'],
                                'ip' => $_SERVER['REMOTE_ADDR']));
                }  
                die();//else $this->redirect('/sign/up');
        }
}
