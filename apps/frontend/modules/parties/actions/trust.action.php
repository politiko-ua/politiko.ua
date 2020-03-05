<?

load::app('modules/parties/controller');
class parties_trust_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( $party = parties_peer::instance()->get_item(request::get_int('id')) )
		{
			$trust_key = 'user_party:trust' . $party['id'] . ':' . session::get_user_id();

			$data = array(
				'id' => $party['id'],
				'trust' => $party['trust'] + ( request::get('trust') ? 1 : 0 ),
				'not_trust' => $party['not_trust'] + ( request::get('trust') ? 0 : 1 )
			);

			$rate_delta = request::get('trust') ? 0.5 : -0.5;

			if ( $this->have_trusted = db_key::i()->exists($trust_key) )
			{
				$this->my_trust = db_key::i()->get($trust_key);

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
					$rate_delta = 0;
					return;
				}
			}

			if ( $this->have_trusted || request::get('trust') )
			{
				parties_peer::instance()->update_rate( $party['id'], $rate_delta, session::get_user_id() );
			}

			parties_peer::instance()->update($data);
		}

		db_key::i()->set($trust_key, request::get_int('trust'));
	}
}
