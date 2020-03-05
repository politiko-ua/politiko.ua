<?

load::view_helper('tag', true);

class user_helper
{
	public static function photo( $id, $size = 'p', $options = array(), $linked = true )
	{
		$html = tag_helper::image(self::photo_path($id, $size), $options, context::get('image_server'));

		if ( !user_data_peer::instance()->get_item($id) )
		{
			$linked = false;
		}

		if ( $linked )
		{
			$data = user_data_peer::instance()->get_item($id);
			$user = user_auth_peer::instance()->get_item($id);
			$title = user_auth_peer::get_type($user['type']) . ' ' . htmlspecialchars($data['first_name'] . ' ' . $data['last_name']);
			
			return "<a title=\"{$title}\" href=\"https://" . context::get('server') . "/profile-{$data['user_id']}\">{$html}</a>";
		}

		return $html;
	}

	public static function photo_path( $id, $size = 'p' )
	{
		$data = user_data_peer::instance()->get_item($id);
		if ( $data['photo_salt'] )
		{
			return "{$size}/user/{$id}{$data['photo_salt']}.jpg";
		}
		else
		{
			return "{$size}/user/0.jpg";
		}
	}

	public static function full_name( $id, $linked = true, $options = array() )
	{
		$data = user_data_peer::instance()->get_item($id);
		$full_name = htmlspecialchars("{$data['first_name']} {$data['last_name']}");

		if ( !trim($full_name) )
		{
			$linked = false;
			$full_name = t('Неизвестный пользователь');
		}

		if ( !$linked )
		{
			return $full_name;
		}

		return "<a " . tag_helper::get_options_html($options) . " href=\"https://" . context::get('server') . "/profile-{$data['user_id']}\">{$full_name}</a>";
	}

	public static function profile_link( $id )
	{
		return "https://" . context::get('server') . "/profile-{$id}";
	}

	public static function login_require( $text )
	{
		$html = '<div class="mt10 p5 acenter fs12" style="border: 1px solid #E4E4E4; background: #F7F7F7;">
				<a href="/">' . $text . '</a>
			</div>';

		return $html;
	}

	public static function share_item( $type, $id, $options = array() )
	{
		$options['onclick'] = "Application.shareItem('{$type}', {$id})";
		$options['href'] = "javascript:;";
		$options['class'] = "share " . $options['class'];

		return "<a " . tag_helper::get_options_html($options) . "><b></b><span>" . t('Поделиться') . "</span></a>";
	}

	public static function bookmark_item( $type, $id, $options = array() )
	{
		if ( bookmarks_peer::instance()->is_bookmarked(session::get_user_id(), $type, $id) )
		{
			return '';
		}

		$options['onclick'] = "Application.bookmarkItem('{$type}', {$id})";
		$options['href'] = "javascript:;";
		$options['class'] = "bookmark " . $options['class'];

		return "<a " . tag_helper::get_options_html($options) . "><b></b><span>" . t('В закладки') . "</span></a>";
	}
}