<?

class comments_add_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();
		load::model('comments');

		if ( $text = trim(request::get('text')) )
		{
			load::action_helper('text', true);
			$text = text_helper::smart_trim($text, 4048);

			$data = array(
				'user_id' => session::get_user_id(),
				'text' => $text,
				'created_ts' => time(),
				'oid' => request::get_int('oid'),
				'otype' => request::get_int('otype'),
				'parent_id' => request::get_int('parent_id')
			);

			$this->id = comments_peer::instance()->insert($data);
			comments_peer::instance()->rate($this->id, session::get_user_id());

			if ( $parent_id = request::get_int('parent_id') )
			{
				$this->child_id = $this->id;

				$comment = comments_peer::instance()->get_item($parent_id);
				$comment['childs'] .= $this->id . ',';
				comments_peer::instance()->update(array(
					'id' => $parent_id,
					'childs' => $comment['childs']
				));
			}
		}

		load::model('user/user_data');
		load::view_helper('user');
	}
}
