<?

load::app('modules/groups/controller');
class groups_view_action extends groups_controller
{
	public function execute()
	{
		$this->group = groups_peer::instance()->get_item(request::get_int('id'));
		client_helper::set_title($this->group['title'] . ' | ' . conf::get('project_name'));

		$this->is_member = groups_members_peer::instance()->is_member($this->group['id'], session::get_user_id());

		if ( ( $this->group['privacy'] == groups_peer::PRIVACY_PRIVATE ) && !$this->is_member )
		{
			load::model('groups/applicants');
			$this->privacy_closed = true;
			return;
		}

		$this->members = groups_members_peer::instance()->get_members($this->group['id']);

		if ( $news = groups_news_peer::instance()->get_by_group($this->group['id']) )
		{
			$this->news = groups_news_peer::instance()->get_item(array_shift($news));
		}

		if ( $talks = groups_topics_peer::instance()->get_by_group($this->group['id']) )
		{
			$this->talks = array_slice($talks, 0, 10);
		}

		load::model('groups/photos');
		$this->photos = groups_photos_peer::instance()->get_by_group($this->group['id']);
		$this->photos = array_slice($this->photos, 0, 10);

		client_helper::set_meta(array(
			'name' => 'description',
			'content' => t('Группа') . ' "' . $this->group['title'] . '"'
		));
		client_helper::set_meta(array(
			'name' => 'keywords',
			'content' => t('Группа') . ', ' . $this->group['title']
		));
	}
}