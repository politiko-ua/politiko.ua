<?

load::app('modules/parties/controller');
class parties_view_action extends parties_controller
{
	public function execute()
	{
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
		client_helper::set_title($this->party['title'] . ' | ' . conf::get('project_name'));

		if ( $this->program = parties_program_peer::instance()->get_by_party($this->party['id']) )
		{
			$this->program = array_slice($this->program, 0, 5);
		}

		if ( $news = parties_news_peer::instance()->get_by_party($this->party['id']) )
		{
			$this->news = parties_news_peer::instance()->get_item(array_shift($news));
		}

		client_helper::register_variable('paryId', $this->party['id']);

		$trust_key = 'user_party:trust' . $this->party['id'] . ':' . session::get_user_id();
		$this->have_trusted = db_key::i()->exists($trust_key);
		$this->my_trust = db_key::i()->get($trust_key);

		$this->members = parties_members_peer::instance()->get_by_party($this->party['id']);

		if ( $this->talks = parties_topics_peer::instance()->get_by_party($this->party['id']) )
		{
			$this->talks = array_slice($this->talks, 0, 10);
		}

		$this->leaders = parties_peer::instance()->get_leaders($this->party['id']);
		$this->set_slot('context', 'partials/leaders');

		client_helper::set_meta(array(
			'name' => 'description',
			'content' => t('Партия') . ' "' . $this->party['title'] . '". ' . t('Обсудить программу партии на сайте Политико - политической социальной сети.')
		));
		client_helper::set_meta(array(
			'name' => 'keywords',
			'content' => t('Партия') . ', ' . $this->party['title']
		));
	}
}