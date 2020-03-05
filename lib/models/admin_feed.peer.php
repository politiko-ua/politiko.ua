<?

class admin_feed_peer extends db_peer_postgre
{
	protected $table_name = 'admin_feed';

	const TYPE_BLOG_COMMENT = 1;
	const TYPE_BLOG_POST = 2;
	const TYPE_DEBATE_COMMENT = 3;
	const TYPE_DEBATE = 4;

	/**
	 * @return admin_feed_peer
	 */
	public static function instance()
	{
		return parent::instance( 'admin_feed_peer' );
	}

	public function add( $user_id, $type, $text )
	{
		parent::insert(array(
			'created_ts' => time(),
			'user_id' => $user_id,
			'type' => $type,
			'text' => $text
		));
	}

	public function get($page = 1, $per_page = 10)
	{
		return db::get_rows(
			'SELECT * FROM ' . $this->get_table_name() . ' ORDER BY id DESC LIMIT :limit OFFSET :offset',
			array('limit' => $per_page, 'offset' => ( $page - 1 ) * $per_page));
	}
}