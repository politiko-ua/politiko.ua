<?

load::model('user/user_auth');
load::model('user/user_data');
load::view_helper('debug');

abstract class frontend_controller extends basic_controller
{
	public function pre_init()
	{
//debug();
		if ( !session::is_authenticated() )
		{
			if ( $auth = cookie::get('auth') )
			{
				$auth_data = explode('|', $auth);
				if ( $auth_data[0] && $auth_data[1] && ( $user = user_auth_peer::instance()->get_by_email($auth_data[0]) ) && $user['active'] && ( $user['password'] == $auth_data[1] ) )
				{
					session::set_user_id( $user['id'], explode(',', $user['credentials']) );
					$user_data = user_data_peer::instance()->get_item( $user['id'] );
					session::set( 'language', $user_data['language'] ? $user_data['language'] : 'ua' );

					load::model('user/user_log');
		                        user_log_peer::instance()->insert(array('user_id' => $user['id'], 'ts' => time(), 'ip' => $_SERVER['REMOTE_ADDR']));

					if ( !$user['ip'] )
					{
						user_auth_peer::instance()->update(array('ip' => $_SERVER['REMOTE_ADDR'], 'id' => $user['id']));
					}
				}
				else
				{
					cookie::set('auth', null, null, '/', '.' . context::get('host'));
				}
			}
		}
		else
		{
			$user = user_auth_peer::instance()->get_item(session::get_user_id());
			setcookie('u', 1, null, '/', '.' . context::get('host'));
			if ( !$user['active'] )
			{
				cookie::set('auth', null, null, '/', '.' . context::get('host'));
				session::unset_user();
			}
		}

		translate::set_lang( session::get('language', 'ua') );

		parent::pre_init();

		client_helper::set_meta(array(
			'name' => 'keywords',
			'content' => t('politiko, политико, выборы, политическая социальная сеть, общество, государство, политика, власть, религия, политология, единомышленники, учетная политика, политика предприятия, нетократия, государственная власть, правовое государство, политическая сеть, политические сети, политические, внешняя политика')
		));
		client_helper::set_meta(array(
			'name' => 'description',
			'content' => 'Политико - политика, власть и общество. Отношения государства и общества. Политическая сеть. Найди политических единомышленников, дискутировать по спорным вопросам, поставить оценку политикам и политическим партиям'
		));
	}

	public function init()
	{
		parent::init();

//debug();
		client_helper::set_title(conf::get('project_name') . ' - ' . t('политическая социальная сеть: Политика, власть и общество'));

		load::model('user/user_data');
		load::view_helper('context');
		load::view_helper('user');
		load::view_helper('date');
		load::action_helper('text', true);
		load::action_helper('tags', true);

		if ( session::is_authenticated() )
		{
			load::model('feed/feed');
			load::model('bookmarks/bookmarks');

			load::model('friends/pending');
			load::model('friends/friends');
			
			$this->pending_friends = friends_pending_peer::instance()->get_by_user(session::get_user_id());
		}

//debug();
		$this->set_slot('top.context', '/partials/context.auth');
	}

	public function post_action()
	{
		if ( session::is_authenticated() )
		{
//debug();
			load::model('messages/messages');
			$this->new_messages = messages_peer::instance()->get_new_count_by_user(session::get_user_id());
		}
	}
}
