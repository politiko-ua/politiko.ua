<?

load::app('modules/admin/controller');
class admin_users_action extends admin_controller
{
	public function execute()
	{
		if ( $this->user_key = request::get('key') )
		{
			load::model('candidates/candidates');
			load::model('user/dictionary');
			load::model('user/user_log');

			if ( is_numeric($this->user_key) )
			{
				$this->user = user_auth_peer::instance()->get_item($this->user_key);
			}
			else
			{
				$this->user = user_auth_peer::instance()->get_by_email($this->user_key);
			}

			if ( $this->user )
			{
				$this->user_data = user_data_peer::instance()->get_item($this->user['id']);
				$this->dictionary_names = user_dictionary_peer::instance()->get_item( $this->user['id'] );
				$this->ips = user_log_peer::instance()->get_by_user( $this->user['id'] );
			}
		}

		if ( $this->user && request::get('submit') )
		{
			user_auth_peer::instance()->update(array(
				'id' => $this->user['id'],
				'active' => request::get_bool('active'),
				'type' => request::get_int('type')
			));

			user_data_peer::instance()->update( array(
				'user_id' => $this->user['id'],
				'rate' => request::get('rate')
			));

			if ( request::get('enable_synonyms') )
			{
				$names = trim(request::get('synonyms'));
				if ( !$names ) $names = $this->user_data['first_name'] . ' ' . $this->user_data['last_name'] . '; ';
				user_dictionary_peer::instance()->set_names( $this->user['id'], $names);
			}
			else
			{
				user_dictionary_peer::instance()->delete_item( $this->user['id'] );
			}

			$this->dictionary_names = user_dictionary_peer::instance()->get_item( $this->user['id'] );

			if ( candidates_peer::instance()->is_candidate($this->user['id']) && !request::get('candidate') )
			{
				candidates_peer::instance()->delete_item($this->user['id']);
			}
			else if ( !candidates_peer::instance()->is_candidate($this->user['id']) && request::get('candidate') )
			{
				candidates_peer::instance()->insert(array(
					'user_id' => $this->user['id']
				));
			}

			if ( candidates_peer::instance()->is_candidate($this->user['id']) && ($votes = (int)request::get('candidate_votes')) )
			{
				load::model('candidates/votes');

				$min_user = db::get_scalar('SELECT MIN(user_id) FROM ' . candidates_votes_peer::instance()->get_table_name());
				if ( $min_user >= 0 )
				{
					$min_user = -1;
				}

				for ( $i = 0; $i < $votes; $i++ )
				{
					candidates_votes_peer::instance()->insert(array(
						'user_id' => --$min_user,
						'candidate_id' => $this->user['id'],
						'ip' => '0.0.0.0',
						'ts' => time()
					));
				}

				mem_cache::i()->delete('candidates_rating');
			}

			if ( !$this->user['active'] && request::get_bool('active') )
			{
				load::system('email/email');

				$email = new email();
				$email->setReceiver($this->user['email']);

				$body =
				$this->user_data['first_name'] . ', ' . t('Ваш аккаунт был активирован') . "\n" .
				"\n" .
			    t('Для входа на сайт зайдите по ссылке: ') . "\n" .
				'https://' . context::get('host') . '/' . "\n" .
				"\n" .
				'Politiko.com.ua';

				$email->setBody($body);
				$email->setSubject( t('Активация аккаунта на') . ' Politiko.com.ua');

				$email->send();
			}

			$this->user = user_auth_peer::instance()->get_item($this->user['id']);
			$this->saved = true;
		}
	}
}
