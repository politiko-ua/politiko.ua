<?

class profile_edit_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( session::has_credential('admin') )
		{
			if ( !$user_id = request::get_int('id') )
			{
				$user_id = session::get_user_id();
			}
		}
		else
		{
			$user_id = session::get_user_id();
		}

		$this->user = user_auth_peer::instance()->get_item($user_id);

		load::model('user/user_data');
		$this->user_data = user_data_peer::instance()->get_item($user_id);

		load::model('user/blacklist');
		$this->blacklist = user_blacklist_peer::get_list( $user_id );

		load::model('candidates/candidates');
		$this->candidate = candidates_peer::instance()->get_item($user_id);
		$this->is_candidate = (bool)$this->candidate;

		load::model('political_views');
		load::view_helper('user');

		client_helper::register_variable('defaultTab', request::get_string('tab', 'common'));
		client_helper::register_variable('politicalViewsSub', political_views_peer::get_sub_list());
		client_helper::register_variable('politicalViewsOther', political_views_peer::get_other_list());
		client_helper::register_variable('userPoliticalViewsSub', $this->user_data['political_views_sub']);

		if ( request::get('submit') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			if ( request::get('type') == 'common' )
			{
				user_data_peer::instance()->update(array(
					'user_id' => $user_id,
					'first_name' => mb_substr(trim(request::get_string('first_name')), 0, 64),
					'last_name' => mb_substr(trim(request::get_string('last_name')), 0, 64),
					'interests' => request::get_string('interests'),
					'political_views' => request::get_int('political_views'),
					'political_views_sub' => request::get_int('political_views_sub'),
					'political_views_custom' => request::get('political_views_custom'),
					'segment' => mb_substr(request::get_string('segment'), 0, 128),
					'position' => mb_substr(request::get_string('position'), 0, 128),
					'city_id' => request::get_int('city_id'),
					'age' => request::get_int('age'),
					'gender' => request::get_string('gender'),
					'show_political_views' => request::get_bool('show_political_views'),
					'contacts' => serialize(request::get('contacts')),
					'bio' => mb_substr(request::get('bio'), 0, 4096)
				));
			}
			else if ( request::get('type') == 'settings' )
			{
				$email = request::get('email');
				if ( $email && strpos($email, '@') && ( $email != $this->user['email'] ) )
				{
					if ( user_auth_peer::instance()->get_by_email($email) )
					{
						$this->json = array('errors' => array('email' => array('Этот email уже используется')));
					}
					else
					{
						user_auth_peer::instance()->update(array(
							'id' => $this->user['id'],
							'email' => strtolower($email)
						));
					}
				}

				if ( $password = request::get_string('new_password') )
				{
					user_auth_peer::instance()->update(array(
						'id' => $this->user['id'],
						'password' => md5($password)
					));
				}

				user_data_peer::instance()->update(array(
					'user_id' => $user_id,
					'notify' => request::get_bool('notify'),
				));
			}
			else if ( request::get('type') == 'program' )
			{
				$program = trim(request::get('program'));
				candidates_peer::instance()->update(array(
					'program' => $program,
					'user_id' => $user_id
				));

				$this->redirect('/profile/edit?id=' . $user_id);
			}
			else if ( request::get('type') == 'photo' )
			{
				load::system('storage/storage_simple');

				load::form('profile/profile_picture');
				$form = new profile_picture_form();
				$form->load_from_request();

				if ( $form->is_valid() )
				{
					$storage = new storage_simple();

					$salt = user_data_peer::instance()->regenerate_photo_salt( $user_id );
					$key = 'user/' . $user_id . $salt . '.jpg';
					$storage->save_uploaded($key, request::get_file('file'));
					$this->json = context::get('image_server') . user_helper::photo_path($user_id);
				}
				else
				{
					$this->json = array('errors' => $form->get_errors());
				}
			}
		}
	}
}
