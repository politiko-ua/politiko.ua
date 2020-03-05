<?

load::app('modules/parties/controller');
class parties_create_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->user_data = user_data_peer::instance()->get_item(session::get_user_id());
		$this->allow_create = ( $this->user_data['rate'] > 300 ) || session::has_credential('admin');

		if ( request::get('submit') && $this->allow_create )
		{
			if ( $title = trim(strip_tags(request::get('title'))) )
			{
				$id = parties_peer::instance()->insert(array(
					'title' => $title,
					'created_ts' => time(),
					'user_id' => session::get_user_id()
				));
			}

			$this->set_renderer('ajax');
			$this->json = array('id' => $id);
		}
	}
}