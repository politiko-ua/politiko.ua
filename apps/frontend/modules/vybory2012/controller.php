<?

abstract class vybory2012_controller extends frontend_controller
{
	public function init()
	{
                parent::init();
		$this->set_layout('public');
		
		load::model('parties/parties');
		load::model('parties/votes2012');
                
		load::view_helper('party');

		client_helper::set_title( t('Выборы в Верховную Раду Украины').' 2012' );
	}
}
