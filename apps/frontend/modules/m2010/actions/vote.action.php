<?

load::app('modules/m2010/controller');
class m2010_vote_action extends m2010_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		$this->id = request::get_int('id');
		candidates_votes_peer::instance()->add(session::get_user_id(), $this->id);
	}
}
