<?

load::app('modules/parties/controller');
class parties_directions_action extends parties_controller
{
	public function execute()
	{
		load::model('political_views');

		chdir(conf::get('project_root') . DIRECTORY_SEPARATOR . 'lib/chart/lib');
		load::lib('chart/lib/OFC/OFC_Chart');

		$title = new OFC_Elements_Title( 'Направления' );

		$directions = parties_peer::instance()->get_directions_cloud();
		$values = array();

		foreach ( $directions as $direction )
		{
			$direction['direction'] = mb_substr(political_views_peer::get_name($direction['direction']), 0, 5) . '.';
			$slice = new OFC_Charts_Pie_Value((int)$direction['total'], $direction['direction']);
			$values[] = $slice;
		}

		$pie = new OFC_Charts_Pie();
		$pie->set_start_angle( 35 );
		$pie->set_animate( true );
		$pie->colours = array('#D11F3D', '#3DD11F', '#1F95D1', '#D1B31F', '#B31FD1');
		$pie->values = $values;
		$pie->tip = '#label# (#percent#)';

		$chart = new OFC_Chart();
		$chart->set_title( $title );
		$chart->add_element( $pie );

		$chart->x_axis = null;

		echo $chart->toString();
		exit;
	}
}