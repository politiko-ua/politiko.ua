<?

load::app('modules/groups/controller');
class groups_create_action extends groups_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->user_data = user_data_peer::instance()->get_item(session::get_user_id());
		$this->allow_create_group = ( $this->user_data['rate'] > 5 ) || session::has_credential('admin');

		if ( request::get('submit') && $this->allow_create_group )
		{
			if ( $title = trim(strip_tags(request::get('title'))) )
			{
				$id = groups_peer::instance()->insert(array(
					'title' => $title,
					'created_ts' => time(),
					'user_id' => session::get_user_id(),
					'type' => request::get_int('type'),
					'teritory' => request::get_int('teritory')
				));

				groups_members_peer::instance()->add($id, session::get_user_id());
			}

			$this->set_renderer('ajax');
			$this->json = array('id' => $id);
		}
	}
}
