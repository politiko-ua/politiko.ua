<?

class search_index_action extends frontend_controller
{
	public function execute()
	{
		if ( $this->keyword = trim(urldecode(request::get('keyword'))) )
		{
			$this->keyword = str_replace(array('\\', '-', '<', '>', '"', '\'', ')', '('), '', $this->keyword);
			$this->keyword = preg_replace('/ +/', ' ', $this->keyword);

			load::model('blogs/posts');
			load::model('debates/debates');
			load::model('polls/polls');
			load::model('parties/parties');
			load::model('groups/groups');

			#$this->blogs = blogs_posts_peer::instance()->search( $this->keyword );
			#$this->debates = debates_peer::instance()->search( $this->keyword );
			#$this->polls = polls_peer::instance()->search( $this->keyword );
			#$this->users = user_data_peer::instance()->search( $this->keyword );
			#$this->parties = parties_peer::instance()->search( $this->keyword );
			#$this->groups = groups_peer::instance()->search( $this->keyword );

			#$this->found = (bool)$this->blogs || (bool)$this->debates || (bool)$this->polls ||
						   (bool)$this->users || (bool)$this->parties || (bool)$this->groups;

			load::view_helper('party');
			load::view_helper('group');
		}
	}
}
