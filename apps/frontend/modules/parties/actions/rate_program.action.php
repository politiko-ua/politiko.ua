<?

load::app('modules/parties/controller');
class parties_rate_program_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( $program = parties_program_peer::instance()->get_item(request::get_int('id')) )
		{
			if ( !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) )
			{
				parties_program_peer::instance()->update(array(
					'id' => $program['id'],
					'for' => $program['for'] + ( request::get_int('positive') ? 1 : 0 ),
					'against' => $program['against'] + ( request::get_int('positive') ? 0 : 1 ),
				));

				parties_program_peer::instance()->rate($program['id'], session::get_user_id());
			}
		}

		$this->set_renderer('ajax');
		$this->json = array();
	}
}