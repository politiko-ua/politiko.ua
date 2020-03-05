var Application = new function()
{
	this.init = function()
	{
		var controllerName = context.module + 'Controller';
		var actionHandler = context.action + 'Action';
		
		eval (
			"if ( typeof(" + controllerName + ") != 'undefined' ) {" +
				" if ( typeof(" + controllerName + "." + actionHandler + ") != 'undefined' ) { " +
					"" + controllerName + "." + actionHandler + "();" +
				"}" +
			"}"
		);
	};

	this.initSignInForm = function()
	{
		var form = new Form(
			'signin_form',
			{
				validators:
				{
					'email': [validatorRequired, validatorEmail],
					'password': [validatorRequired]
				},
				success: function( response )
				{
					if ( response.referer )
					{
						document.location = response.referer;
					}
					else
					{
						document.location.reload();
					}
				}
			}
		);

		form.get('email').focus();
	};

	this.addToFriends = function( userId )
	{
		Popup.show();
		$.get('/friends/add?id=' + userId, function( response ) { Popup.setHtml(response); Popup.position(); }, 'raw');
	};

	this.makeFriends = function( userId )
	{
		$.get('/friends/make?id=' + userId, function( response ) {
			Popup.setHtml(response);
			setTimeout(function() { Popup.close(500); }, 1000);
			$('#menu_add_friends').hide();
		}, 'raw');
	};

	this.addToBlacklist = function( userId )
	{
		Popup.show();
		$.get('/friends/blacklist?id=' + userId, function( response ) { Popup.setHtml(response); Popup.position(); }, 'raw');
	};

	this.doBlacklist = function( userId )
	{
		$.get('/friends/ban?id=' + userId, function( response ) {
			Popup.setHtml(response);
			setTimeout(function() { Popup.close(500); }, 1000);
			$('#menu_blacklist').hide();
		}, 'raw');
	};

	this.shareItem = function( type, id )
	{
		Popup.show();
		$.post(
			'/messages/share',
			{id: id, type: type},
			function( response ) { Popup.setHtml(response); Popup.position(); }
		);
	};

	this.shareItemProcess = function()
	{
		if ( $('.friend_check[checked:true]').length == 0 )
		{
			alert( $('#share_form').attr('rel') );
			return false;
		}

		$.post('/messages/share', $('#share_form').serialize());

		Popup.setHtml('<div class="screen_message fs11">' + $('.popup_header').attr('rel') + '</div>');
		Popup.position();
		$('#popup_box').fadeOut( 1500 );

		return false;
	};

	this.friendSelect = function( id, do_select )
	{
		if ( typeof do_select == 'undefined' )
		{
			do_select = !$('#friend_' + id).hasClass('selected');
		}

		if ( !do_select )
		{
			$('#friend_' + id).removeClass('selected');
			$('#friend_check_' + id).attr('checked', false);
		}
		else
		{
			$('#friend_' + id).addClass('selected');
			$('#friend_check_' + id).attr('checked', true);
		}
	};

	this.friendsToggle = function()
	{
		$('.friend').each(function() {
			Application.friendSelect( $(this).attr('rel'), $('#select_all_friends').attr('checked') );
		});
	};

	this.bookmarkItem = function(type, id)
	{
		$('.bookmark').fadeOut(150);

		$.post('/bookmarks/add', { type: type, id: id });
	};
}

$(document).ready( Application.init );