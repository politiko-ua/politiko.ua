<?

class votes2014_peer extends db_peer_postgre
{
	protected $table_name = 'votes2014';

	/**
	 * @return parties_peer
	 */
	public static function instance()
	{
		return parent::instance( 'votes2014_peer' );
	}
        
	public function get_by_user( $president_id )
	{
		return db::get_scalar('SELECT count(*) FROM votes2014 WHERE president_id = :value LIMIT 1', array('value' => $president_id));
	}
        
	public function is_voted( $user_id ) // на случай если будем проверять голосовал ли до этого
	{
		return db::get_row('SELECT * FROM ' . $this->table_name . ' WHERE user_id = :value LIMIT 1', array('value' => $user_id));
	}
        
        public function remove_votes( $user_id ) // удаляем все голоса товарища(перед добавлением нового голоса)
	{       
                if ($user_id>0) return db::get_row('DELETE FROM ' . $this->table_name . ' WHERE user_id = :value', array('value' => $user_id));
	}
        public function remove_vk_votes( $vk_id ) // удаляем все голоса товарища(перед добавлением нового голоса)
	{       
                if ($vk_id>0) return db::get_row('DELETE FROM ' . $this->table_name . ' WHERE vkid = :value', array('value' => $vk_id));
	}
        
        
}