<?

class groups_news_peer extends db_peer_postgre
{
	protected $table_name = 'groups_news';

	/**
	 * @return groups_news_peer
	 */
	public static function instance()
	{
		return parent::instance( 'groups_news_peer' );
	}

	public function get_by_group( $id )
	{
		return $this->get_list(array('group_id' => $id));
	}

	public function get_new()
	{
		return $this->get_list(array(), array(), array('id DESC'), 100, array('groups_news_new', 60*60));
	}
}