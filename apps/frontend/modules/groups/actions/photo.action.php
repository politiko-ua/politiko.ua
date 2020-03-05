<?

load::app('modules/groups/controller');
class groups_photo_action extends groups_controller
{
	public function execute()
	{
		if ( !$this->group = groups_peer::instance()->get_item(request::get_int('id')) )
		{
			$this->redirect('/groups');
		}

		if ( ( $this->group['privacy'] == groups_peer::PRIVACY_PRIVATE ) && !groups_members_peer::instance()->is_member($this->group['id'], session::get_user_id()) )
		{
			$this->redirect('/group' . $this->group['id']);
		}

		load::model('groups/photos');
		load::model('groups/photos_albums');

		if ( $this->album_id = request::get_int('album_id', null) )
		{
			$this->album = groups_photos_albums_peer::instance()->get_item($this->album_id);
		}

		if ( $this->album_id !== null )
		{
			$this->photos = groups_photos_peer::instance()->get_by_group($this->group['id'], $this->album_id);
			$this->pager = pager_helper::get_pager($this->photos, request::get_int('page'), 20);
			$this->photos = $this->pager->get_list();
		}
		else
		{
			$this->albums = groups_photos_albums_peer::instance()->get_by_group($this->group['id']);
			array_unshift($this->albums, 0);
		}
	}
}