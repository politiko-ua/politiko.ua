<?

load::app('modules/parties/controller');
class parties_edit_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
		if ( !parties_peer::instance()->is_moderator($this->party['id'], session::get_user_id()) )
		{
			$this->redirect('/');
		}

		$this->moderators = parties_peer::instance()->get_moderators($this->party['id']);
		$this->leaders = parties_peer::instance()->get_leaders($this->party['id']);

		client_helper::register_variable('partyId', $this->party['id']);

		if ( $program = parties_program_peer::instance()->get_by_party($this->party['id']) )
		{
			foreach ( $program as $program_id )
			{
				$program_item = parties_program_peer::instance()->get_item($program_id);
				$this->program[$program_item['segment']] = $program_item;
			}
		}

		$this->news = parties_news_peer::instance()->get_by_party($this->party['id']);

		if ( request::get('submit') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			if ( request::get('type') == 'common' )
			{
				parties_peer::instance()->update(array(
					'id' => $this->party['id'],
					'description' => request::get_string('description'),
					'direction' => request::get_int('direction'),
					'direction_custom' => request::get_string('direction_custom'),
					'url' => request::get_string('url'),
					'title' => trim(strip_tags(request::get_string('title'))),
					'aims' => request::get_string('aims'),
					'contacts' => serialize(request::get('contacts')),
				));
			}
			else if ( request::get('type') == 'photo' )
			{
				load::system('storage/storage_simple');

				load::form('party/picture');
				$form = new party_picture_form();
				$form->load_from_request();

				if ( $form->is_valid() )
				{
					$storage = new storage_simple();

					$salt = parties_peer::instance()->regenerate_photo_salt( $this->party['id'] );
					$key = 'party/' . $this->party['id'] . $salt . '.jpg';
					$storage->save_uploaded($key, request::get_file('file'));
					$this->json = context::get('image_server') . party_helper::photo_path($this->party['id']);
				}
				else
				{
					$this->json = array('errors' => $form->get_errors());
				}
			}
			else if ( request::get('type') == 'program' )
			{
				parties_program_peer::instance()->save($this->party['id'], request::get('program'));
			}
			else if ( request::get('type') == 'news' )
			{
				$this->id = parties_news_peer::instance()->insert(array(
					'party_id' => $this->party['id'],
					'created_ts' => time(),
					'text' => trim(request::get_string('text'))
				));

				$this->set_renderer('html');
				$this->set_template('news_item');
				$this->disable_layout();
			}
		}
	}
}