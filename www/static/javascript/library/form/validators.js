var validatorRequired = function ( value )
{
	if ( $.trim(value) == '' )
	{
		return 'required';
	}

	return null;
}

var validatorRegexp = function ( value, exp )
{
	if ( !value.match(exp) )
	{
		return 'wrong';
	}

	return null;
}

var validatorLength = function ( value, min )
{
	if ( value.length < min )
	{
		return 'too_short';
	}

	return null;
}

var validatorEmail = function ( value )
{
	var s = new String(value);

	if ( !s.match(/[^@]+@.+\.[a-z]+/) )
	{
		return 'email';
	}

	return null;
}