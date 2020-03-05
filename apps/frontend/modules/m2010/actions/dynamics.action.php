<?

load::app('modules/m2010/controller');
class m2010_dynamics_action extends m2010_controller
{
	public function execute()
	{
		$this->rating = candidates_votes_peer::instance()->get_rating();
		$this->rating = array_slice($this->rating, 0, 5);

		$graph_data = array();

		foreach ( $this->rating as $data )
		{
			if ( !$candidate_id = $data['id'] ) continue;

			$votes = $data['votes'];
			$dynamics = candidates_votes_peer::instance()->get_dynamics( $candidate_id );

			foreach ( $dynamics as $row )
			{
				$summary_dynamics[$candidate_id][date('m/d', $row['ts'])] = $row['count'];

				$votes -= $row['count'];
				$graph_data[date('m/d', $row['ts'])][$candidate_id] = $votes;
			}
		}

		krsort($graph_data);

		foreach ( $this->rating as $data )
		{
			if ( !$candidate_id = $data['id'] ) continue;

			$votes = $data['votes'];

			foreach ( $graph_data as $date => $date_data )
			{
				$votes -= $summary_dynamics[$candidate_id][$date];
				$graph_data[$date][$candidate_id] = $votes;
			}
		}

		reset($graph_data);
		$first = current($graph_data);

		end($graph_data);
		$last = current($graph_data);

		$max_votes = max($first);
		$min_votes = min($last);

		$graph_data = array_reverse($graph_data);

		chdir(conf::get('project_root') . DIRECTORY_SEPARATOR . 'lib/chart/lib');
		load::lib('chart/lib/OFC/OFC_Chart');

		$lines = array();
		$labels = array();

		foreach ( $graph_data as $date => $row_data )
		{
			foreach ( $row_data as $id => $val )
			{
				$lines[$id][] = $val;
			}
			
			$x_labels[] = $date;
		}

		$title = new OFC_Elements_Title( t('Динамика голосования') );
		$title->set_style('font-size: 8px;');

		$colors = array('#9BE198', '#98a9e1', '#e1cd98', '#e198a6', '#ab98e1');

		foreach ( $lines as $id => $line )
		{
			$line_1 = new OFC_Charts_Line_Dot();
			$line_1->set_values( $line );
			$line_1->set_halo_size( 0 );
			$line_1->set_width( 2 );
			$line_1->set_dot_size( 3 );
			$line_1->set_colour( array_shift($colors) );
			$line_1->set_key( user_helper::full_name($id, false), 12);

			$graph_lines[] = $line_1;
		}

		$y = new OFC_Elements_Axis_Y();
		$step = ceil(( $max_votes - $min_votes )/4);
		$y->set_range( $min_votes, $max_votes, $step );
		$y->set_grid_colour('#E7F0F8');
		$y->set_colour('#E7F0F8');

		$labels = new OFC_Elements_Axis_X_Label_Set();
		$labels->set_vertical();
		$labels->set_labels( $x_labels );
		$labels->set_colour('#AAAAAA');

		$x = new OFC_Elements_Axis_X();
		$x->set_grid_colour('#E7F0F8');
		$x->set_colour('#E7F0F8');
		$x->set_labels( $labels );

		$chart = new OFC_Chart();
		$chart->set_title( $title );
		$chart->set_bg_colour( '#FFFFFF' );

		if ( $graph_lines ) foreach ( $graph_lines as $graph_line )
		{
			$chart->add_element( $graph_line );
		}
		
		$chart->set_y_axis( $y );
		$chart->set_x_axis( $x );

		echo $chart->toString();
		exit;
	}
}
