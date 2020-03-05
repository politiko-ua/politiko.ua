<?

class blogs_post_action extends frontend_controller
{
	public function execute()
	{
		$this->selected_menu = '/blogs';

		load::model('blogs/posts');
		if ( !$this->post_data = blogs_posts_peer::instance()->get_item( request::get_int('id') ) )
		{
			$this->redirect('/blogs');
		}

		if ( !session::get('post_viewed_' . $this->post_data['id']) )
		{
			blogs_posts_peer::instance()->update(array('views' => $this->post_data['views'] + 1, 'id' => $this->post_data['id']));
			session::set('post_viewed_' . $this->post_data['id'], true);
		}

		client_helper::register_variable('postId', $this->post_data['id']);
		client_helper::set_title($this->post_data['title'] . ' | ' . conf::get('project_name'));

		load::model('blogs/mentions');
		$this->mentioned = blogs_mentions_peer::instance()->get_by_post( $this->post_data['id'] );

		load::model('blogs/comments');
		$this->comments = blogs_comments_peer::instance()->get_by_post( $this->post_data['id'] );

		load::model('user/user_data');
		load::view_helper('user');

		load::model('blogs/posts_tags');
		$this->set_slot('context', 'partials/context.posts');
		$this->similar = blogs_posts_peer::instance()->get_similar($this->post_data['id'], 5);

		load::model('user/blacklist');
		$this->is_blacklisted = user_blacklist_peer::is_banned( $this->post_data['user_id'], session::get_user_id() );

		client_helper::set_meta(array(
			'name' => 'description',
			'content' => $this->post_data['title']
		));
		client_helper::set_meta(array(
			'name' => 'keywords',
			'content' => str_replace(' ', ', ', $this->post_data['title'])
		));
	}
}