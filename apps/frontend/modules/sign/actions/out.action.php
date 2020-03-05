<?

class sign_out_action extends frontend_controller
{
	public function execute()
	{
		if ( session::is_authenticated() )
		{
			session::unset_user();
			cookie::set('auth', null, time() + 60*60*24*31, '/', '.' . context::get('host'));
			setcookie('u', null, null, '/', '.' . context::get('host'));
		}

		$this->redirect('/');
	}
}
