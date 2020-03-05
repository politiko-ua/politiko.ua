<?

load::app('modules/m2010/controller');
class m2010_forecast_action extends m2010_controller
{
	public function execute()
	{
		load::model('candidates/forecast');
		$this->winner_id = 103363;
		$this->winner_error = 8.84;
		$this->winner_forecast = candidates_forecast_peer::instance()->get_by_user( 103363 );
	}
}
