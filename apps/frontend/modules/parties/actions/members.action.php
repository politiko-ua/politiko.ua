<?

load::app('modules/parties/controller');
class parties_members_action extends parties_controller
{
	public function execute()
	{
		if ( $this->party = parties_peer::instance()->get_item( request::get_int('id') ) )
		{
			client_helper::set_title( t('Участники партии') . ' ' . $this->party['title'] . ' | ' . conf::get('project_name'));

			$this->list = parties_members_peer::instance()->get_by_party( $this->party['id'] );
			$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 16);
			$this->list = $this->pager->get_list();
		}
	}
}