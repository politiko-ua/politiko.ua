<?

class blogs_comment_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		load::model('blogs/comments');

		if ( $text = trim(request::get('text')) )
		{
			load::action_helper('text', true);
			$text = text_helper::smart_trim($text, 4048);

			load::model('blogs/posts');
			if ( !$post = blogs_posts_peer::instance()->get_item(request::get_int('post_id')) )
			{
				return;
			}

			load::model('user/blacklist');
			if ( user_blacklist_peer::is_banned( $post['user_id'], session::get_user_id() ) )
			{
				return;
			}

			$data = array(
				'user_id' => session::get_user_id(),
				'text' => $text,
				'created_ts' => time(),
				'post_id' => request::get_int('post_id'),
				'parent_id' => request::get_int('parent_id')
			);

			$post = blogs_posts_peer::instance()->get_item(request::get_int('post_id'));
			blogs_comments_peer::instance()->rate($this->id, session::get_user_id());

			if ( $post['user_id'] != session::get_user_id() )
			{
				user_data_peer::instance()->update_rate($post['user_id'], 0.1);
			}

			$this->id = blogs_comments_peer::instance()->insert($data);
                        
                        if(request::get('neg_msg')==1) {
                                if (!blogs_posts_peer::instance()->has_rated($post['id'], session::get_user_id()) )
                                {
                                        blogs_posts_peer::instance()->update( array(
                                                'id' => $post['id'],
                                                'for' => $post['for'],
                                                'against' => $post['against'] + 1
                                        ) );

                                        user_data_peer::instance()->update_rate($post['user_id'], -1, session::get_user_id());
                                        blogs_posts_peer::instance()->rate($post['id'], session::get_user_id());

                                        load::model('rate_history');
                                        rate_history_peer::instance()->insert(array(
                                                'type' => rate_history_peer::TYPE_BLOG_POST,
                                                'object_id' => $post['id'],
                                                'user_id' => session::get_user_id(),
                                                'rate' => '-1'
                                        ));
                                }
                                db_key::i()->set ('negative_blog_comment:'.$this->id, 1);
                        }
                            

			if ( $parent_id = request::get_int('parent_id') )
			{
				$this->child_id = $this->id;

				$comment = blogs_comments_peer::instance()->get_item($parent_id);
				$comment['childs'] .= $this->id . ',';
				blogs_comments_peer::instance()->update(array(
					'id' => $parent_id,
					'childs' => $comment['childs']
				));
			}

			if ( $post['user_id'] != session::get_user_id() )
			{
				load::action_helper('user_email', false);
				user_email_helper::send(
					$post['user_id'],
					session::get_user_id(),
					array(
						'subject' => t('Новый комментарий к записи в блоге'),
						'body' => '%receiver%, ' . t('к Вашей записи в блоге добавили комментарий') . ':' . "\n\n" .
								  '%sender% ' . t('пишет') . ':' . "\n" . $text . "\n\n" .
								  t('Что-бы ответить, перейдите по ссылке:') . "\n" .
								  'https://' . context::get('host') . '/blogpost' . $data['post_id'] . '#comment' . $this->id
					)
				);
			}

			load::view_helper('tag', true);

			ob_start();
			include dirname(__FILE__) . '/../../feed/views/partials/items/blog_post_comment.php';
			$feed_html = ob_get_clean();

			$readers = bookmarks_peer::instance()->get_by_object(bookmarks_peer::TYPE_BLOG_POST, $post['id']);
			$readers[] = $post['user_id'];
			$readers = array_unique(array_diff($readers, array(session::get_user_id())));
			feed_peer::instance()->add(session::get_user_id(), $readers, array(
				'actor' => session::get_user_id(),
				'text' => $feed_html,
				'action' => feed_peer::ACTION_BLOG_POST_COMMENT,
				'section' => feed_peer::SECTION_DISCUSSIONS,
			));
		}

		load::model('user/user_data');
		load::view_helper('user');
	}
}
