<?

load::system('storage/abstract_storage');

class storage_simple extends abstract_storage
{
	public $enable_extensions = false;

	public function get( $key )
	{
		if ( $this->exists($key) )
		{
			return file_get_contents($this->get_path($key), $data);
		}
	}

	public function exists( $key )
	{
		return is_file($this->get_path($key));
	}

	public function set( $key, $data )
	{
		$path = $this->get_path($key);
		$this->prepare_path($path);

		file_put_contents($path, $data);
	}

	public function prepare_path( $path )
	{
		$dir = dirname($path);

		$create = array();

		while ( !is_dir($dir) )
		{
			$create[] = $dir;
			$dir = dirname($dir);
		}

		$create = array_reverse($create);

		foreach ( $create as $dir )
		{
			mkdir($dir);
		}
	}

	public function get_path( $key, $absolute_path = true )
	{
		$hash = md5($key);

		$file_path = '';

		for ( $i = 0; $i < 4; $i ++ )
		{
			$file_path .= substr($hash, $i * 2, 2) . '/';
		}

		$file_path .= md5($hash);

		if ( $this->enable_extensions )
		{
			$file_path .= '.' . pathinfo($key, PATHINFO_EXTENSION);
		}

		$path = $file_path;
		if ( $absolute_path )
		{
			$path = conf::get('file_storage_path') . '/' . $path;
		}

		return $path;
	}

	public function save_uploaded( $key, $file_data )
	{
		$path = $this->get_path($key);
		$this->prepare_path($path);

		move_uploaded_file($file_data['tmp_name'], $path);
	}

	public function save_from_path( $key, $src )
	{
		$path = $this->get_path($key);
		$this->prepare_path($path);

		copy($src, $path);
	}
}
