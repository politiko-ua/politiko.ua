<?

class groups_topics_messages_peer extends db_peer_postgre
{
	protected $table_name = 'groups_topics_messages';

	/**
	 * @return groups_topics_messages_peer
	 */
	public static function instance()
	{
		return parent::instance( 'groups_topics_messages_peer' );
	}

	public function get_by_topic( $id )
	{
		return $this->get_list(array('topic_id' => $id), array(), array('id ASC'));
	}
}