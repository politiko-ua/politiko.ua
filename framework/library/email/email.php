<?

class email
{
    private $options = array();

    public function  __construct( $receiver = null, $subject = null, $body = null )
    {
        $this->setReceiver( $receiver );
        $this->setSubject( $subject );
        $this->setBody( $body );
    }

    public function setOption( $name, $value )
    {
        $this->options[$name] = $value;
    }

    public function setSender( $email, $name = null )
    {
        $this->setOption('sender', $email);
		$this->setOption('sender_name', $name);
    }

    public function setReceiver( $email )
    {
        $this->setOption('receiver', $email);
    }

    public function setSubject( $subject )
    {
        $this->setOption('subject', $subject);
    }

    public function setBody( $body )
    {
        $this->setOption('body', $body);
    }

    public function send()
    {
		if ( !$this->options['sender'] )
		{
			$this->setSender(conf::get('default_email'), conf::get('project_name'));
		}

		if ( conf::get('debug_emails') )
		{
			$this->send_debug();
		}
		else
		{
		$headers = 'From: ' . $this->options['sender_name'] . '<' . $this->options['sender'] . ">\r\n" .
                	'Reply-To: ' . $this->options['sender'] . "\r\n" .
	                'X-Mailer: PHP/' . phpversion();

        	mail($this->options['receiver'], $this->options['subject'], $this->options['body'], $headers);

//			require_once dirname(__FILE__) . '/mailer/class.phpmailer.php';
//			$mail = new PHPMailer();
//			$mail->IsSendmail();
//			$mail->CharSet = 'utf-8';
//			$mail->From     = $this->options['sender'];
//			$mail->FromName = $this->options['sender_name'];
//			$mail->Subject    = $this->options['subject'];
//			$mail->Body    = $this->options['body'];
//			$mail->AddAddress( $this->options['receiver'] );

//			$mail->Send();
		}
    }

	public function send_debug()
	{
		$path = conf::get('project_root') . '/data/debug/mails/' . date('h_i_s') . '.mail';
		
		$data =
		"Subject: {$this->options['subject']}\n" .
		"Receiver: {$this->options['receiver']}\n" .
		"From: {$this->options['sender']}\n\n" .
		"{$this->options['body']}\n";

		file_put_contents($path, $data);
	}
}
