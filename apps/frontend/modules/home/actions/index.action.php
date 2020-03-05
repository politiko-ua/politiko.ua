<?

class home_index_action extends frontend_controller
{
	public function execute()
	{
		load::model('blogs/posts');
		load::model('blogs/tags');
		load::model('blogs/posts_tags');
		load::model('blogs/comments');

		$list = blogs_posts_peer::instance()->get_casted();
		$this->list = array_slice($list, 0, 8);

		$this->load_news();

		load::model('polls/polls');
		load::model('polls/answers');
		load::model('polls/votes');

		$polls = polls_peer::instance()->get_newest();
		$this->new_polls = array_slice($polls, 0, 5);

		load::model('debates/debates');
		load::model('debates/arguments');

		$debates = debates_peer::instance()->get_newest();
		$this->new_debates = array_slice($debates, 0, 3);

		$this->set_slot('context', 'partials/context.polls');

		load::model('parties/members');
		load::model('parties/parties');
		load::view_helper('party');
	}

	protected function load_news()
	{
		$list = blogs_posts_peer::instance()->get_newest( blogs_posts_peer::TYPE_NEWS_POST );
		$this->news = array_slice($list, 0, 5);

		load::model('parties/parties');
		load::model('parties/news');

		$parties_news = parties_news_peer::instance()->get_new();
		$parties_news = array_slice($parties_news, 0, 5);

		$list = array();
		foreach ( $parties_news as $id )
		{
			$data = parties_news_peer::instance()->get_item( $id );
			$list[$data['created_ts']] = $data;
		}

		load::model('groups/groups');
		load::model('groups/news');

		$groups_news = groups_news_peer::instance()->get_new();
		$groups_news = array_slice($groups_news, 0, 5);

		foreach ( $groups_news as $id )
		{
			$data = groups_news_peer::instance()->get_item( $id );
			$list[$data['created_ts']] = $data;
		}

		krsort($list);

		$this->social_news = array_slice($list, 0, 5);
	}
}
