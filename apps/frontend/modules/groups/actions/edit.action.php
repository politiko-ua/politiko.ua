<?

load::app('modules/groups/controller');
class groups_edit_action extends groups_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->group = groups_peer::instance()->get_item(request::get_int('id'));
		if ( !groups_peer::instance()->is_moderator($this->group['id'], session::get_user_id()) )
		{
			$this->redirect('/');
		}

		client_helper::register_variable('groupId', $this->group['id']);

		$this->moderators = groups_peer::instance()->get_moderators($this->group['id']);

		if ( $this->group['privacy'] == groups_peer::PRIVACY_PRIVATE )
		{
			load::model('groups/applicants');
			$this->applicants = groups_applicants_peer::instance()->get_by_group($this->group['id']);
		}

		if ( request::get('submit') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			if ( request::get('type') == 'common' )
			{
				groups_peer::instance()->update(array(
					'id' => $this->group['id'],
					'description' => request::get_string('description'),
					'teritory' => request::get_int('teritory', 1),
					'type' => request::get_int('gtype', 1),
					'url' => request::get_string('url'),
					'title' => trim(strip_tags(request::get_string('title'))),
					'aims' => request::get_string('aims'),
					'privacy' => request::get_int('privacy'),
				));
			}
			else if ( request::get('type') == 'photo' )
			{
				load::system('storage/storage_simple');

				load::form('group/picture');
				$form = new group_picture_form();
				$form->load_from_request();

				if ( $form->is_valid() )
				{
					$storage = new storage_simple();

					$salt = groups_peer::instance()->regenerate_photo_salt( $this->group['id'] );
					$key = 'group/' . $this->group['id'] . $salt . '.jpg';
					$storage->save_uploaded($key, request::get_file('file'));
					$this->json = context::get('image_server') . group_helper::photo_path($this->group['id']);
				}
				else
				{
					$this->json = array('errors' => $form->get_errors());
				}
			}
			else if ( request::get('type') == 'news' )
			{
				$this->id = groups_news_peer::instance()->insert(array(
					'group_id' => $this->group['id'],
					'created_ts' => time(),
					'text' => trim(request::get_string('text'))
				));
			}
		}
	}
}