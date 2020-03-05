<?

load::app('modules/blogs/controller');
class blogs_promote_action extends blogs_controller
{
	protected $authorized_access = false;

	public function execute()
	{
		load::model('blogs/posts');
		$this->post_data = blogs_posts_peer::instance()->get_item( request::get_int('id') );

		$this->bank_id = 8384;
		$this->amount = 0.5;
		$this->order = db_key::i()->increment('payment_transaction');
		$this->description = 'Оплата продвижения поста в блоге Politiko.com.ua';

		$this->sign = md5(
			$this->bank_id . '::' .
			$this->order . '::' .
			$this->amount . '::' .
			0 . '::' .
			$this->description . '::' .
			conf::get('sms_secret')
		);
	}
}
