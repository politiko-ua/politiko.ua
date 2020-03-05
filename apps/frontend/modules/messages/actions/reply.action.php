<?

load::app('modules/messages/controller');
class messages_reply_action extends messages_controller
{
	public function execute()
	{
		$this->disable_layout();

		$this->thread = messages_threads_peer::instance()->get_item(request::get_int('thread_id'));
		if ( ( $this->thread['sender_id'] == session::get_user_id() ) || ( $this->thread['receiver_id'] == session::get_user_id() ) )
		{
			$this->id = messages_peer::instance()->reply( array(
				'thread_id' => $this->thread['id'],
				'body' => trim(request::get('body')),
				'sender_id' => session::get_user_id(),
				'receiver_id' => $this->thread['receiver_id'] == session::get_user_id() ? $this->thread['sender_id'] : $this->thread['receiver_id']
			) );

			load::action_helper('user_email', false);
			user_email_helper::send(
				$this->thread['receiver_id'] == session::get_user_id() ? $this->thread['sender_id'] : $this->thread['receiver_id'],
				session::get_user_id(),
				array(
					'subject' => '%sender%: ' . t('Новое сообщение'),
					'body' => '%sender% ' . t('пишет') . ':' . "\n\n" . trim(request::get('body')) . "\n\n" .
							  t('Что-бы ответить, перейдите по ссылке:') . "\n" .
							  'https://' . context::get('host') . '/messages/view?id=' . $this->thread['id']
				)
			);
		}
	}
}