<?

class pay_finish_action extends frontend_controller
{
	public function execute()
	{
		error_log('Payment finish: ' . print_r($_POST, 1));
	}
}