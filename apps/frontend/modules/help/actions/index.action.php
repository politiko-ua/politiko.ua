<?

class help_index_action extends frontend_controller
{
	public function execute()
	{
		foreach ( $_GET as $key => $value )
		{
			if ( !$value )
			{
				$this->document = $key;
				$this->document = str_replace(array('.', '/'), '', $this->document);
				$this->document = str_replace(array(' '), '_', $this->document);
			}
		}

		$this->document_path =  $path = conf::get('project_root') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'help' . DIRECTORY_SEPARATOR . $this->document . '.php';

		if ( !$this->document || ( !is_file($this->document_path) && !session::has_credential('admin') ) )
		{
			$this->document = 'Помощь';
			$this->document_path =  $path = conf::get('project_root') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'help' . DIRECTORY_SEPARATOR . $this->document . '.php';
		}

		$titles = array('Календарный_План' => 'Календариний план місцевих виборів 2010');
		if ( !$title = $titles[$this->document] )
			$title = t(str_replace('_', ' ', $this->document));

		client_helper::set_title( $title );

		if ( $_POST['body'] )
		{
			file_put_contents($this->document_path, $_POST['body']);
		}

		ob_start();
		if (is_file($this->document_path)) include $this->document_path;
		$this->html = ob_get_clean();
	}
}
