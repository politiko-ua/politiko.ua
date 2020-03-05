<?

class blogs_soc_share_action extends frontend_controller
{

	public function execute()
	{
                $protect_key=request::get('type').'_counter:'.request::get('id').':'.(session::get_user_id() ? session::get_user_id() : ip2long($_SERVER['REMOTE_ADDR']));
                if (!db_key::i()->exists($protect_key))
                {
                    db_key::i()->set($protect_key,1);
                    $key=request::get('type').'_counter:'.request::get('id');
                    db_key::i()->set($key, (int)db_key::i()->get($key)+1);
                    
                }
                $this->set_renderer('ajax');
                $this->json = array();
	}
}
