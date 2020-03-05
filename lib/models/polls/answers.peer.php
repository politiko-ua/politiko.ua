<?

class polls_answers_peer extends db_peer_postgre
{
	protected $table_name = 'polls_answers';

	/**
	 * @return polls_answers_peer
	 */
	public static function instance()
	{
		return parent::instance( 'polls_answers_peer' );
	}

	public function get_by_poll( $poll_id )
	{
		return $this->get_list( array('poll_id' => $poll_id) );
	}
}