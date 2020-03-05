var friendsController = new function()
{
	this.decline = function( userId )
	{
		$.post(
			'/friends/decline',
			{user_id: userId},
			function( response ) { $('#friend_' + userId).fadeOut( 150 ); }
		);
	};

	this.accept = function( userId )
	{
		$.post(
			'/friends/accept',
			{user_id: userId},
			function( response ) { $('#friend_' + userId).fadeOut( 150 ); }
		);
	};

	this.deleteFriend = function( id )
	{
		if ( confirm(this.l_are_you_sure) )
		{
			$('#friend_' + id).fadeOut( 150 );
			$.post( '/friends/delete', {id: id} );
		}
	},

	this.inviteAction = function()
	{
		var form = new Form(
			'invite_form',
			{
				validators:
				{
					'name': [validatorRequired],
					'email': [validatorRequired, validatorEmail]
				},
				success: function( response )
				{
					$('.success').fadeIn(150);
					form.get('email').val('');
					form.get('name').val('');
				}
			}
		);

		form.get('email').focus();
                
		var send_form = new Form(
			'form_send_invites',
			{
				success: function()
				{
                                    $('#form_send_invites').hide();
                                    $('.success').fadeIn(150);
				}
			}
		);
	}
        
};