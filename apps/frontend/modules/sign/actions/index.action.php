<?

class sign_index_action extends frontend_controller
{
    public function execute()
    {
		if ( session::is_authenticated() )
		{
			$this->redirect('/home');
		}

		$this->set_layout('public');

		load::model('blogs/posts');
		$this->casted = blogs_posts_peer::instance()->get_casted();
		$this->casted = array_slice($this->casted, 0, 3);

		load::model('blogs/comments');
		$this->discussed = blogs_posts_peer::instance()->get_discussed();;
		if ( !$this->discussed ) $this->discussed = $this->casted;
		$this->discussed = array_shift($this->discussed);

		load::model('blogs/mentions');
		$this->mentions = blogs_mentions_peer::instance()->get_hot();

		if ( !$this->mentions ) $this->mentions = array(
			array('user_id' => 104033, 'total' => 25),
			array('user_id' => 102398, 'total' => 17),
			array('user_id' => 102399, 'total' => 17)
		);

		foreach ( $this->mentions as $mention )
		{
			$history = blogs_mentions_peer::instance()->get_history($mention['user_id']);
			foreach ( $history as $data ) $chart_data[$data['doy']] = $data['total'];

			for ( $i = 29; $i > 0; $i-- )
			{
				$dt = date('Y-m-d', time() - 60*60*24*($i) );
				$this->history[$mention['user_id']][$dt] = (int)$chart_data[$dt];
				$chart_max = max((int)$chart_data[$dt], $chart_max);
			}
		}

		if ( !$chart_max ) $chart_max = 2;

		$chart_data = array();
		foreach ( $this->history as $user_id => $chart )
		{
			foreach ( $chart as $k => $v ) $new_chart[$k] = floor(100*$v/$chart_max);
			$chart = $new_chart;

			$chart_data[] = implode(',', $chart);
			$chart_names[] = user_helper::full_name($user_id, false);
		}

		$this->mentions_chart = 'https://chart.apis.google.com/chart?cht=lc' .
								'&chs=620x150' .
								'&chd=t:' . implode('|', $chart_data) .
								'&chco=0BB875,A9B562,E67A07' .
								'&chdl=' . implode('|', $chart_names) .
								'&chxt=x,y' .
								'&chxl=0:|месяц|три недели|две недели|прошлая неделя|вчера|1:|' .
								'|' . $chart_max;


    }
}
