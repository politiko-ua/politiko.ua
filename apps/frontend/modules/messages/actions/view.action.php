<?

load::app('modules/messages/controller');
class messages_view_action extends messages_controller
{
	public function execute()
	{
		$this->thread = messages_threads_peer::instance()->get_item(request::get_int('id'));
		if ( ( $this->thread['sender_id'] != session::get_user_id() ) && ( $this->thread['receiver_id'] != session::get_user_id() ) )
		{
			$this->redirect('/messages');
		}
		
		$list = messages_peer::instance()->get_by_thread(request::get_int('id'), session::get_user_id());
		$this->list = array();
		foreach ( $list as $id )
		{
			$message = messages_peer::instance()->get_item($id);

			if ( !$message['is_read'] )
			{
				messages_peer::instance()->update(array(
					'id' => $id,
					'is_read' => true
				));

				$reset_new_count = true;
			}

			$this->list[] = $message;
		}

		if ( $reset_new_count )
		{
			messages_peer::instance()->reset_new_messages(session::get_user_id());
		}
	}
}