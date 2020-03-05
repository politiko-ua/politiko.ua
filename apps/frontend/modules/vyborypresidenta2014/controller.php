<?

abstract class vyborypresidenta2014_controller extends frontend_controller
{
	public function init()
	{
        parent::init();
		$this->set_layout('public');
		
		load::model('user/user_data');
		load::model('user/votes2014');
                
		load::view_helper('user');

		client_helper::set_title( t('Выборы Президента Украины').' 2014' );
	}
}
