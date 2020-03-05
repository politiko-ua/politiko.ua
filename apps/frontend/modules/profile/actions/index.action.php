<?

class profile_index_action extends frontend_controller
{
	public function execute()
	{
		$this->user = user_auth_peer::instance()->get_item( request::get_int('id') ? request::get_int('id') : session::get_user_id() );
		if ( !$this->user || !$this->user['active'] )
		{
			throw new public_exception( t('Пользователь не найден') );
		}

		load::model('user/user_data');
		$this->user_data = user_data_peer::instance()->get_item( $this->user['id'] );

		$title = user_auth_peer::get_type($this->user['type']) . ' ';
		$title .= $this->user_data['first_name'] . ' ' . $this->user_data['last_name'] . ' | ' . conf::get('project_name');
		client_helper::set_title( $title );

		client_helper::set_meta(array(
			'name' => 'description',
			'content' => $title
		));
		client_helper::set_meta(array(
			'name' => 'keywords',
			'content' => $title
		));

		client_helper::register_variable('profileId', $this->user_data['user_id']);

		load::view_helper('user');

		load::model('ideas/ideas');
		$list = ideas_peer::instance()->get_by_user( $this->user['id'] );
		$this->ideas_list = array_slice($list, 0, 3);

		load::model('blogs/posts');
		load::model('blogs/comments');
		$list = blogs_posts_peer::instance()->get_by_user( $this->user['id'] );
		$this->blog_list = array_slice($list, 0, 3);

		load::model('polls/polls');
		load::model('polls/answers');
		load::model('polls/votes');

		$polls = polls_peer::instance()->get_by_user( $this->user['id'] );
		$this->polls = array_slice($polls, 0, 3);

		load::model('debates/debates');
		load::model('debates/arguments');

		$debates = debates_peer::instance()->get_by_user( $this->user['id'] );
		$this->debates = array_slice($debates, 0, 3);

		load::model('parties/members');
		load::model('parties/parties');
		load::view_helper('party');

		if ( $this->party_id = parties_members_peer::instance()->get($this->user['id']) )
		{
			$this->party = parties_peer::instance()->get_item($this->party_id);
		}

		$this->have_trusted = user_data_peer::instance()->has_trusted($this->user_data['user_id'], session::get_user_id());
		$this->my_trust = user_data_peer::instance()->my_trust($this->user_data['user_id'], session::get_user_id());

		load::model('user/questions');
		$this->set_slot('context', 'partials/questions');
		if ( $this->questions = user_questions_peer::instance()->get_by_profile($this->user['id']) )
		{
			$this->questions = array_slice($this->questions, 0, 5);
		}

		load::model('groups/members');
		if ( $this->groups = groups_members_peer::instance()->get_groups($this->user['id']) )
		{
			load::model('groups/groups');
			load::view_helper('group');
		}

		load::model('political_views');

		load::model('user/blacklist');
	}
}
