<?

load::app('modules/m2010/controller');
class m2010_tour1_action extends m2010_controller
{
	public function execute()
	{
		$this->rating = array(
array('id' => 102398, 'votes' => 35.32),	
array('id' => 102390, 'votes' => 25.05),	
array('id' => 104483, 'votes' => 13.06),	
array('id' => 102400, 'votes' => 6.96),	
array('id' => 104033, 'votes' => 5.45),	
array('id' => 103584, 'votes' => 3.55),	
array('id' => 102396, 'votes' => 2.35),	
array('id' => 0, 'votes' => 2.2),	
array('id' => 102399, 'votes' => 1.43),	
array('id' => 103319, 'votes' => 1.2),	
array('id' => 104199, 'votes' => 0.41),	
array('id' => 105943, 'votes' => 0.38),	
array('id' => 105140, 'votes' => 0.22),	
array('id' => 106087, 'votes' => 0.19),	
array('id' => 105944, 'votes' => 0.16),	
array('id' => 105164, 'votes' => 0.14),	
array('id' => 106686, 'votes' => 0.12),	
array('id' => 105168, 'votes' => 0.06),	
array('id' => 105017, 'votes' => 0.03),
		);

		load::model('blogs/posts');
		load::model('blogs/tags');
		load::model('blogs/posts_tags');
		$this->tag = 'Выборы 2010';
		if ( $tag_id = blogs_tags_peer::instance()->get_by_name($this->tag) )
		{
			$this->news = blogs_posts_peer::instance()->get_by_tag($tag_id);
			$this->news = array_slice($this->news, 0, 10);
		}
	}
}
