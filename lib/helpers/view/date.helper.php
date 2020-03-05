<?

class date_helper
{
	public static function get_day_name( $number )
	{
		$days = array(
			1 => t('Понедельник'),
			2 => t('Вторник'),
			3 => t('Среда'),
			4 => t('Четверг'),
			5 => t('Пятница'),
			6 => t('Субота'),
			7 => t('Воскресение')
		);

		return $days[$number];
	}

	public static function human( $ts, $separator = '<br />' )
	{
		return self::get_day_name(date('N', $ts)) . $separator . '<b>' . date('H:i', $ts) . '</b>' . $separator . date('d.m.y', $ts);
	}
}
