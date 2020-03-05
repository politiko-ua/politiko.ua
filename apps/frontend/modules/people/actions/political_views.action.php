<?

class people_political_views_action extends frontend_controller
{
	public function execute()
	{
		load::model('political_views');

		chdir(conf::get('project_root') . DIRECTORY_SEPARATOR . 'lib/chart/lib');
		load::lib('chart/lib/OFC/OFC_Chart');

		$title = new OFC_Elements_Title( t('Политические взгляды') );

		$directions = user_data_peer::instance()->get_views_cloud();
		$values = array();

		foreach ( $directions as $direction )
		{
			if ( $direction['political_views'] )
			{
				$direction['political_views'] = political_views_peer::get_name($direction['political_views']);
				$direction['political_views'] = mb_substr($direction['political_views'], 0, 5) . '.';
				$slice = new OFC_Charts_Pie_Value((int)$direction['total'], $direction['political_views']);
				$values[] = $slice;
			}
		}

		$pie = new OFC_Charts_Pie();
		$pie->set_start_angle( 15 );
		$pie->set_animate( true );
		$pie->colours = array('#D11F3D', '#3DD11F', '#1F95D1', '#D1B31F', '#B31FD1', '#7EECDA', '#5A1FD1');
		$pie->values = $values;
		$pie->tip = '#label# #percent#';

		$chart = new OFC_Chart();
		$chart->set_title( $title );
		$chart->add_element( $pie );

		$chart->x_axis = null;

		echo $chart->toString();
		exit;
	}
}