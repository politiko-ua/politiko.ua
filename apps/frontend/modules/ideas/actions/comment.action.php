<?

load::app('modules/ideas/controller');
class ideas_comment_action extends ideas_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		if ( $text = trim(request::get('text')) )
		{
			load::action_helper('text', true);
			$text = text_helper::smart_trim($text, 4048);

			if ( !$idea = ideas_peer::instance()->get_item(request::get_int('idea_id')) )
			{
				return;
			}

			$data = array(
				'user_id' => session::get_user_id(),
				'text' => $text,
				'created_ts' => time(),
				'idea_id' => request::get_int('idea_id'),
				'parent_id' => request::get_int('parent_id')
			);

			$idea_data = ideas_peer::instance()->get_item(request::get_int('idea_id'));
			user_data_peer::instance()->update_rate($idea_data['user_id'], 0.1);

			$this->id = ideas_comments_peer::instance()->insert($data);
			ideas_comments_peer::instance()->rate($this->id, session::get_user_id());

			if ( $parent_id = request::get_int('parent_id') )
			{
				$this->child_id = $this->id;

				$comment = ideas_comments_peer::instance()->get_item($parent_id);
				$comment['childs'] .= $this->id . ',';
				ideas_comments_peer::instance()->update(array(
					'id' => $parent_id,
					'childs' => $comment['childs']
				));
			}

			if ( $idea['user_id'] != session::get_user_id() )
			{
				load::action_helper('user_email', false);
				user_email_helper::send(
					$idea['user_id'],
					session::get_user_id(),
					array(
						'subject' => t('Новый комментарий к Вашей идее'),
						'body' => '%receiver%, ' . t('к Вашей идее добавили комментарий') . ':' . "\n\n" .
								  '%sender% ' . t('пишет') . ':' . "\n" . $text . "\n\n" .
								  t('Что-бы ответить, перейдите по ссылке:') . "\n" .
								  'https://' . context::get('host') . '/idea' . $data['idea_id'] . '#comment' . $this->id
					)
				);
			}
		}

		load::model('user/user_data');
		load::view_helper('user');
	}
}