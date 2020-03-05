<?

load::app('modules/admin/controller');
class admin_maillist_action extends admin_controller
{
	public function execute()
	{
		if ( request::get('send') )
		{
			$this->sent = 0;
			
			load::system('email/email');

			$subject_tpl = trim(request::get_string('subject'));
			$body_tpl = trim(request::get_string('body'));

			if ( request::get('mail_mode') == 'unknown' )
			{
				$this->send_unknown($subject_tpl, $body_tpl);
			}
			else
			{
				$this->send_known($subject_tpl, $body_tpl);
			}

			
		}
	}

	public function send_unknown($subject_tpl, $body_tpl)
	{
die('disabled');
		$emails = request::get('email');
		$names = request::get('name');
		foreach ( $emails as $i => $mail ) if ( $mail = trim($mail) )
		{
			$name = trim($names[$i]);

			$subject = str_replace('NAME', $name, $subject_tpl);
			$body = str_replace('NAME', $name, $body_tpl);

			$email = new email();
			$email->setSender('i@politiko.com.ua', 'Politiko.com.ua info');
			$email->setReceiver($mail);
			$email->setSubject( $subject );
			$email->setBody( $body );

			$email->send();

			$this->sent++;
		}
	}

	public function send_known($subject_tpl, $body_tpl)
	{
		mem_cache::i()->disable_inner_cache();

		$list = array();
		switch ( request::get('filter') )
		{
			case 'common':
				$list = user_auth_peer::instance()->get_list();
				break;
			case 'party':
				load::model('parties/members');
				$list = db::get_cols('SELECT user_id FROM ' . parties_members_peer::instance()->get_table_name() . ' WHERE party_id IN (' . implode(',', request::get('parties')) . ')');
				break;
			case 'group':
				load::model('groups/members');
				$list = db::get_cols('SELECT user_id FROM ' . groups_members_peer::instance()->get_table_name() . ' WHERE group_id IN (' . implode(',', request::get('groups')) . ')');
				break;
			case 'political_views':
				load::model('political_views');
				$list = db::get_cols('SELECT user_id FROM ' . user_data_peer::instance()->get_table_name() . ' WHERE political_views = ' . request::get_int('political_views'));
				break;
			case 'age':
				load::model('political_views');
				$from = request::get_int('age_from');
				$to = request::get_int('age_to');
				$list = db::get_cols('SELECT user_id FROM ' . user_data_peer::instance()->get_table_name() . ' WHERE age > :from AND age < :to', array('from' => $from, 'to' => $to));
				break;

			case 'city':
				$city_id = request::get_int('city');
				$list = db::get_cols('SELECT user_id FROM ' . user_data_peer::instance()->get_table_name() . ' WHERE city_id = :id', array('id' => $city_id));
                                break;
		}

		foreach ( $list as $user_id )
		{
			$user = user_auth_peer::instance()->get_item($user_id);
			if ( !$user['active'] ) continue;

			$user_data = user_data_peer::instance()->get_item($user_id);

			$name = $user_data['first_name'];

			$subject = str_replace('NAME', $name, $subject_tpl);
			$body = str_replace('NAME', $name, $body_tpl);

			$email = new email();
			$email->setSender('i@politiko.com.ua', 'Politiko.com.ua info');
			$email->setReceiver( $user['email'] );
			$email->setSubject( $subject );
			$email->setBody( $body );

			$email->send();

			$this->sent++;
		}
	}
}
