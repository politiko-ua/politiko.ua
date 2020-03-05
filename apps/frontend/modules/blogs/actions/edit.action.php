<?

load::app('modules/blogs/controller');
class blogs_edit_action extends blogs_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->selected_menu = '/blogs';

		load::model('blogs/posts');
		load::model('blogs/mentions');

		$this->blog_types = array(
			blogs_posts_peer::TYPE_BLOG_POST => t('Свой материал'),
			blogs_posts_peer::TYPE_NEWS_POST => t('Новость'),
			blogs_posts_peer::TYPE_HUMOR_POST => t('Юмор'),
			blogs_posts_peer::TYPE_COPIED_POST => t('Копипаст'),
		);

		if ( request::get_int('id') )
		{
			$this->post_data = blogs_posts_peer::instance()->get_item( request::get_int('id') );
			if ( ( $this->post_data['user_id'] != session::get_user_id() ) && !session::has_credential('moderator') )
			{
				$this->redirect('/blog-' . session::get_user_id());
			}
		}

		if ( $mentions = blogs_mentions_peer::instance()->get_by_post( $this->post_data['id'] ) )
		{
			foreach ( $mentions as $user_id )
			{
				$user_data = user_data_peer::instance()->get_item($user_id);

				$this->mentioned[] = array(
					'id' => $user_id,
					'full_name' => $user_data['first_name'] . ' ' . $user_data['last_name']
				);
			}

			client_helper::register_variable('mentioned', $this->mentioned);
		}


		if ( request::get('submit') && trim(request::get('body')) && trim(request::get('title')) )
		{
			$tags = blogs_tags_peer::instance()->string_to_array(request::get('tags'));

			$clean_text = blogs_posts_peer::instance()->clean_text( request::get('body') );
			$render_text = blogs_posts_peer::instance()->namize_text( $clean_text, $named_users );

			load::action_helper('text', true);
			$data = array(
				'title' => mb_substr(trim(request::get('title')), 0, 256),
				'body' => $clean_text,
				'text_rendered' => $render_text,
				'preview' => nl2br(text_helper::smart_trim(strip_tags($clean_text), 256)),
				'tags_text' => implode(', ', $tags),
				# 'public' => session::has_credential('editor'),
				'type' => request::get_int('type')
			);

			if ( session::has_credential('admin') )
			{
				$data['views'] = request::get_int('views');
			}

			if ( !$this->post_data )
			{
				$data['created_ts'] = time();
				$data['sort_ts'] = time();
				$data['user_id'] = session::get_user_id();
				$data['public'] = session::has_credential('editor');
				$post_id = blogs_posts_peer::instance()->insert( $data );
				blogs_posts_peer::instance()->rate($post_id, session::get_user_id());

				load::model('feed/feed');
				load::view_helper('tag', true);

				ob_start();
				include dirname(__FILE__) . '/../../feed/views/partials/items/blog_post.php';
				$feed_html = ob_get_clean();
				
				$readers = friends_peer::instance()->get_by_user(session::get_user_id());
				feed_peer::instance()->add(session::get_user_id(), $readers, array(
					'actor' => session::get_user_id(),
					'text' => $feed_html,
					'action' => feed_peer::ACTION_BLOG_POST,
					'section' => feed_peer::SECTION_PERSONAL,
				));
			}
			else
			{
				$post_id = $data['id'] = $this->post_data['id'];
				blogs_posts_peer::instance()->update( $data );
				blogs_posts_tags_peer::instance()->delete_by_post($post_id);
			}

			$mentions = (array)request::get('mentioned');
			$mentions = array_unique(array_merge($mentions, $named_users));
			blogs_mentions_peer::instance()->save_mentions($post_id, $mentions);

			foreach ( $tags as $tag )
			{
				$tag = mb_substr($tag, 0, 48);

				$tag_id = blogs_tags_peer::instance()->obtain_id($tag);
				blogs_posts_tags_peer::instance()->insert(array(
					'post_id' => $post_id,
					'tag_id' => $tag_id
				));
			}

			$this->redirect('/blogpost' . $post_id);
		}
	}
}
