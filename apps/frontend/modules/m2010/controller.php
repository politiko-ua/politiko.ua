<?

abstract class m2010_controller extends frontend_controller
{
	public function init()
	{
		parent::init();
		$this->set_layout('public');

		load::model('candidates/candidates');
		load::model('candidates/votes');

		client_helper::set_title( 'Выборы в местные советы. Местные выборы 2010' );
	}
}
