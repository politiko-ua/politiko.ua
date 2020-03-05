<?

load::model('messages/threads');

class messages_peer extends db_peer_postgre
{
	protected $table_name = 'messages';

	/**
	 * @return messages_peer
	 */
	public static function instance()
	{
		return parent::instance( 'messages_peer' );
	}

	public function add( $data, $owner_copy = true )
	{
		$thread_id = messages_threads_peer::instance()->insert(array(
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id'],
		));

		if ( $owner_copy )
		{
			$this->insert(array(
				'owner' => $data['sender_id'],
				'sender_id' => $data['sender_id'],
				'receiver_id' => $data['receiver_id'],
				'body' => $data['body'],
				'attached' => $data['attached'],
				'created_ts' => time(),
				'thread_id' => $thread_id,
				'is_read' => true
			));

			mem_cache::i()->delete('user_messages:' . $data['sender_id']);
		}

		$this->insert(array(
			'owner' => $data['receiver_id'],
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id'],
			'body' => $data['body'],
			'attached' => $data['attached'],
			'created_ts' => time(),
			'thread_id' => $thread_id,
			'is_read' => false
		));

		mem_cache::i()->delete('user_messages:' . $data['receiver_id']);
		$this->reset_new_messages($data['receiver_id']);

		return $thread_id;
	}

	public function reply( $data )
	{
		$id = $this->insert(array(
			'owner' => $data['sender_id'],
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id'],
			'body' => $data['body'],
			'created_ts' => time(),
			'thread_id' => $data['thread_id'],
			'is_read' => true
		));

		$this->insert(array(
			'owner' => $data['receiver_id'],
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id'],
			'body' => $data['body'],
			'created_ts' => time(),
			'thread_id' => $data['thread_id'],
			'is_read' => false
		));

		mem_cache::i()->delete('user_messages:' . $data['sender_id']);
		mem_cache::i()->delete('user_messages:' . $data['receiver_id']);
		$this->reset_new_messages($data['receiver_id']);

		return $id;
	}

	public function get_by_user( $user_id )
	{
		$sql = '
		SELECT MAX(id) as id
		FROM ' . $this->table_name . '
		WHERE
			owner = :user_id
		GROUP BY thread_id
		ORDER BY id DESC
		';

		return db::get_cols($sql, array('user_id' => $user_id), $this->connection_name, 'user_messages:' . $user_id);
	}

	public function get_new_count_by_user( $user_id )
	{
		$sql = '
		SELECT count(id)
		FROM ' . $this->table_name . '
		WHERE
			owner = :user_id AND
			"is_read" = false';

		return db::get_scalar($sql, array('user_id' => $user_id), $this->connection_name, 'user_new_messages:' . $user_id);
	}

	public function reset_new_messages( $user_id )
	{
		mem_cache::i()->delete('user_new_messages:' . $user_id);
	}

	public function get_by_thread( $id, $user_id )
	{
		return $this->get_list(array('thread_id' => $id, 'owner' => $user_id), array(), array('id ASC'));
	}

	public function delete_by_thread( $id, $user_id )
	{
		$sql = 'DELETE FROM ' . $this->table_name . ' WHERE owner = :user_id AND thread_id = :id';
		db::exec($sql, array('id' => $id, 'user_id' => $user_id));
		mem_cache::i()->delete('user_messages:' . $user_id);
		$this->reset_new_messages($user_id);
	}
}