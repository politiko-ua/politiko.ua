<?

load::app('modules/messages/controller');
class messages_share_action extends messages_controller
{
	public function execute()
	{
		load::view_helper('tag', true);

		$this->disable_layout();
		$this->friends = friends_peer::instance()->get_by_user(session::get_user_id());

		$this->icons = array(
			'blog_post' => 'blogs',
			'debate' => 'debates',
			'poll' => 'polls',
			'idea' => 'ideas',
			'group' => 'groups',
			'party' => 'parties',
		);

		$this->types = array(
			'blog_post' => t('Запись в блоге'),
			'debate' => t('Дебаты'),
			'poll' => t('Опрос'),
			'idea' => t('Идея'),
			'group' => t('Группа'),
			'party' => t('Партия'),
		);

		$this->type = request::get('type');

		if ( !$this->types[$this->type] )
		{
			return;
		}

		switch ( $this->type )
		{
			case 'blog_post':
				load::model('blogs/posts');
				$this->data = blogs_posts_peer::instance()->get_item(request::get_int('id'));
				break;

			case 'debate':
				load::model('debates/debates');
				$this->data = debates_peer::instance()->get_item(request::get_int('id'));
				break;

			case 'poll':
				load::model('polls/polls');
				$this->data = polls_peer::instance()->get_item(request::get_int('id'));
				break;

			case 'idea':
				load::model('ideas/ideas');
				$this->data = ideas_peer::instance()->get_item(request::get_int('id'));
				break;

			case 'party':
				load::view_helper('party');
				load::model('parties/parties');
				$this->data = parties_peer::instance()->get_item(request::get_int('id'));
				break;

			case 'group':
				load::view_helper('group');
				load::model('groups/groups');
				$this->data = groups_peer::instance()->get_item(request::get_int('id'));
				break;
		}

		if ( $this->data['user_id'] == session::get_user_id() )
		{
			$this->error = t('Свой контент рекомендовать нельзя');
			return;
		}

		if ( mem_cache::i()->get('share_user_' . session::get_user_id()) )
		{
			$this->error = t('Рекомендовать контент можно не чаще, чем раз в час');
			return;
		}

		mem_cache::i()->set('share_user_' . session::get_user_id(), true, 60*60);

		ob_start();
		include dirname(__FILE__) . '/../views/partials/share/' . $this->type . '.php';
		$this->html = ob_get_clean();

		if ( $selected_friends = request::get('friends') )
		{
			if ( $selected_friends = array_intersect($selected_friends, $this->friends) )
			{
				load::model('messages/messages');
				load::action_helper('user_email', false);

				if ( !$body = trim(request::get('body')) )
				{
					$body = t('Привет, хочу поделиться с тобой полезной информацией') . ':';
				}

				foreach ( $selected_friends as $friend_id )
				{
					$id = messages_peer::instance()->add(array(
						'sender_id' => session::get_user_id(),
						'receiver_id' => $friend_id,
						'body' => $body,
						'attached' => $this->html
					), false);

					user_email_helper::send(
						$friend_id,
						session::get_user_id(),
						array(
							'subject' => '%sender%:' . t('Новое сообщение'),
							'body' => '%sender% ' . t('пишет') . ':' . "\n\n" . trim(request::get('body')) . "\n\n" .
									  t('Что-бы ответить, перейдите по ссылке:') . "\n" .
									  'https://' . context::get('host') . '/messages/view?id=' . $id
						)
					);
				}
			}

			$this->set_renderer('ajax');
			$this->json = $selected_friends;
		}
	}
}