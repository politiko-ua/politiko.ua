<?

abstract  class blogs_controller extends frontend_controller
{
	public function init()
	{
		parent::init();

		load::model('blogs/posts');
		load::model('blogs/tags');
		load::model('blogs/posts_tags');
		load::model('blogs/comments');

		load::action_helper('pager', true);

		client_helper::set_title( t('Блоги') . ' | ' . conf::get('project_name') );
	}

	public function post_action()
	{
		parent::post_action();

		$this->selected_menu = '/blogs';

		$newest = blogs_posts_peer::instance()->get_newest();
		$this->newest = array_slice($newest, 0, 15);

		if ( $this->top_tags = blogs_tags_peer::instance()->get_top() )
		{
			foreach ( $this->top_tags as $tag )
			{
				$meta_keywords[] = blogs_tags_peer::instance()->get_name($tag['id']);
			}
		}

		load::model('user/user_data');
		load::view_helper('user');

		client_helper::set_meta(array(
			'name' => 'description',
			'content' => t('Блоги')
		));

		if ( $meta_keywords )
		{
			client_helper::set_meta(array(
				'name' => 'keywords',
				'content' => implode(', ', $meta_keywords)
			));
		}
	}
}
