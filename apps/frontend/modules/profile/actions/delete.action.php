<?

class profile_delete_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->hash = md5(microtime());
		session::set('delete_hash', $this->hash);
		
		$this->disable_layout();
	}
}