<?

class pay_result_action extends frontend_controller
{
	public function execute()
	{
		error_log('Payment result: ' . print_r($_POST, 1));

		$sign = md5(
			conf::get('sms_secret') . '::' .
			$_POST['s_purse'] . '::' .
			$_POST['s_order_id'] . '::' .
			$_POST['s_amount'] . '::' .
			$_POST['s_clear_amount'] . '::' .
			$_POST['s_inv'] . '::' .
			$_POST['s_phone']
		);

		if ( $sign == $_POST['s_sign_v2'] )
		{
			load::model('blogs/posts');
			blogs_posts_peer::instance()->promote( $_POST['post_id'] );
		}

		$this->set_renderer('ajax');
		$this->json = 'ok';
	}
}