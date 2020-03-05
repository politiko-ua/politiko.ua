<?

load::app('modules/m2010/controller');
class m2010_results_action extends m2010_controller
{
	public function execute()
	{
		$this->rating = candidates_votes_peer::instance()->get_rating();
		foreach ( $this->rating as $line )
		{
			$this->votes_total += $line['votes'];
		}

		if ( !$this->votes_total ) $this->votes_total = 1;

		if ( session::is_authenticated() )
		{
			$this->my_vote = candidates_votes_peer::instance()->get_vote_by_user(session::get_user_id());
		}
	}
}
