<?

class profile_trust_action extends frontend_controller
{
	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( $user = user_data_peer::instance()->get_item(request::get_int('id')) )
		{
			$data = array(
				'user_id' => $user['user_id'],
				'trust' => $user['trust'] + ( request::get('trust') ? 1 : 0 ),
				'not_trust' => $user['not_trust'] + ( request::get('trust') ? 0 : 1 )
			);

			if ( $this->have_trusted = user_data_peer::instance()->has_trusted($user['user_id'], session::get_user_id()) )
			{
				$this->my_trust = user_data_peer::instance()->my_trust($user['user_id'], session::get_user_id());

				if ( request::get('trust') && !$this->my_trust )
				{
					$data['not_trust']--;
				}
				else if ( !request::get('trust') && $this->my_trust )
				{
					$data['trust']--;
				}
				else
				{
					return;
				}
			}

			user_data_peer::instance()->update($data);
			user_data_peer::instance()->trust($user['user_id'], session::get_user_id(), request::get_int('trust'));

			if ( request::get('trust') || $this->have_trusted )
			{
				$rate_delta = request::get('trust') ? 0.5 : -0.5;
				user_data_peer::instance()->update_rate( $user['user_id'], $rate_delta, session::get_user_id() );
			}
		}
	}
}
