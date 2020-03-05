<?php

load::app('modules/blogs/controller');

class blogs_index_action extends blogs_controller
{
	public function execute()
	{
		load::view_helper('tag', true);

		if ( $this->tag = trim(request::get('tag')) )
		{
			if ( $tag_id = blogs_tags_peer::instance()->get_by_name( $this->tag ) )
			{
				$this->list = blogs_posts_peer::instance()->get_by_tag($tag_id);
				tag_helper::$rss = 'https://' . context::get('host') . '/blogs/rss?tag=' . urlencode(request::get('tag'));

				client_helper::set_title($this->tag . ' | ' . conf::get('project_name'));
			}
			else
			{
				$this->redirect('/blogs');
			}
		}
		else
		{
			$this->list = blogs_posts_peer::instance()->get_casted();
			tag_helper::$rss = 'https://' . context::get('host') . '/blogs/rss';
		}

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 8);
		$this->list = $this->pager->get_list();
	}
}
