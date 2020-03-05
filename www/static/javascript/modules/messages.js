var messagesController = new function()
{
	this.composeAction = function ()
    {
		var form = new Form(
			'compose_form',
			{
				validators:
				{
					receiver: [validatorRequired],
					body: [validatorRequired]
				},
				success: function()
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
					document.location = '/messages';
				},
				preSubmit: function()
				{
					var receiverId = null;
					if ( messagesController.friendsNames )
					{
						var receiverId = messagesController.friendsNames[$('#receiver').val()];
					}
					if ( !receiverId )
					{
						receiverId = form.get('receiver_id').val();
					}

					if ( receiverId )
					{
						form.get('receiver_id').val(receiverId);
						return true;
					}

					return false;
				}
			}
		);

		form.get('body').focus();

		form.get('receiver').autocomplete({
			get : function( key ) {
				var res = [];
				for ( var id in messagesController.friends )
				{
					if ( messagesController.friends[id].toLowerCase().indexOf(key.toLowerCase()) >= 0 )
					{
						res.push({id: id, value: messagesController.friends[id]});
					}
				}

				return res;
			},
			callback: function( obj ) {
				form.get('receiver_id').val( obj.id );
			},
			cache: false,
			delay: 50,
			minchars: 1,
			noresults: '-'
		});

		if ( this.receiverName )
		{
			form.get('receiver').val( this.receiverName );
		}
		else
		{
			form.get('receiver').inlineHint( $('#compose_form').attr('rel') );
		}
    };

	this.viewAction = function ()
    {
		var form = new Form(
			'reply_form',
			{
				validators:
				{
					body: [validatorRequired]
				},
				success: function( response )
				{
					$('#messages').append(response);
					form.get('body').val('');
					form.get('body').focus();
				},
				format: 'raw'
			}
		);

		form.get('body').focus();
    };

	this.indexAction = function ()
    {
		$('.thread').hover(function(){
			$(this).addClass('box').removeClass('box_empty');
		}, function() {
			$(this).removeClass('box').addClass('box_empty');
		});
    };

	this.markAsRead = function()
	{
		if ( $('#messages_form').serialize() )
		{
			$.post('/messages/mark_read', $('#messages_form').serialize(), function(){
				document.location.reload();
			}, 'json');
		}
	};

	this.bulkDelete = function()
	{
		if ( $('#messages_form').serialize() && confirm($('#bulk_delete').attr('rel')) )
		{
			$.post('/messages/bulk_delete', $('#messages_form').serialize(), function(){
				document.location.reload();
			}, 'json');
		}
	};
};
