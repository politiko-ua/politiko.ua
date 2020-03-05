<?

class request
{
	public static function get( $name, $default = null )
	{
		if ( $_REQUEST[$name] !== null )
		{
			return $_REQUEST[$name];
		}
		
		return $default;
	}
	
	public static function get_int( $name, $default = 0 )
	{
		$value = self::get( $name );
		
		return $value !== null ? (int)$value : $default;
	}

	public static function get_bool( $name, $default = false )
	{
		$value = self::get( $name );

		return $value !== null ? (bool)$value : (bool)$default;
	}
	
	public static function get_string( $name, $default = '' )
	{
		$value = self::get( $name );
		
		return $value !== null ? (string)$value : $default;
	}

	public static function get_all()
	{
		return $_REQUEST;
	}

	public static function get_file( $name )
	{
		return $_FILES[$name];
	}
}