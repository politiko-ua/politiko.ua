<?

load::system('email/email');

class user_email_helper
{
	public static function send( $receiver_id, $sender_id = null, $options = array() )
	{
		$receiver = user_auth_peer::instance()->get_item($receiver_id);
		$receiver_data = user_data_peer::instance()->get_item($receiver_id);

		if ( !$receiver['email'] || ( strpos($receiver['email'], '@') === false ) )
		{
			return;
		}

		if ( !$receiver_data['notify'] )
		{
			return;
		}

		if ( $sender_id )
		{
			$sender = user_auth_peer::instance()->get_item($sender_id);
			$sender_data = user_data_peer::instance()->get_item($sender_id);
		}

		$variables = array(
			'%sender%' => $sender_data['first_name'] . ' ' . $sender_data['last_name'],
			'%receiver%' => $receiver_data['first_name'],
		);

		$variables = array_merge($variables, (array)$options['variables']);
		$options['body'] = str_replace(array_keys($variables), $variables, $options['body']);
		$options['subject'] = str_replace(array_keys($variables), $variables, $options['subject']);

		$email = new email();
		$email->setReceiver( $receiver['email'] );

		$body =
			$options['body'] .
			"\n\n" .
		    t('Не отвечайте на это письмо, оно сгенерировано автоматически') . "\n" .
			'Politiko.com.ua';

		$email->setBody($body);
		$email->setSubject($options['subject']);

		$email->send();
	}
}