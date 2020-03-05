var groupsController = new function()
{
	this.viewAction = function()
	{
		$('.tab_pane > a').bind('click', function() {
			$('.tab_pane > a').removeClass('selected');
			$(this).addClass('selected');
			$('.content_pane').hide();
			$('#pane_' + $(this).attr('rel')).show();
			$(this).blur();
		});
	}

	this.createAction = function ()
    {
		var form = new Form(
			'add_form',
			{
				validators:
				{
					title: [validatorRequired]
				},
				success: function( response )
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
					document.location = '/group' + response.id;
				}
			}
		);
    };

	this.editAction = function ()
    {
		var commonForm = new Form(
			'common_form',
			{
				validators:
				{
					title: [validatorRequired]
				},
				success: function()
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
				},
				wait_panel: 'common_wait'
			}
		);

		var photoForm = new Form(
			'photo_form',
			{
				success: function( uri )
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
					$('#photo').attr('src', uri);
				},
				wait_panel: 'photo_wait'
			}
		);

		var newsForm = new Form(
			'news_form',
			{
				validators: {
					text: [validatorRequired]
				},
				success: function( response )
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
				},
				wait_panel: 'news_wait',
				format: 'raw'
			}
		);

		$('.tab_menu').click(function() {
			$('.tab_menu').removeClass('selected');
			$(this).addClass('selected');
			$(this).blur();
			$('.form').hide();
			$('#' + $(this).attr('rel') + '_form').show();
		});
    };

	this.join = function( groupId )
	{
		$.post(
			'/groups/join',
			{id: groupId},
			function () { $('#menu_join').hide(); $('#menu_leave').fadeIn(150); },
			'json'
		);
	};

	this.apply = function( groupId )
	{
		$('#menu_leave').remove();
		this.join(groupId);
		$('#menu_apply').hide();
		$('#text_apply').fadeIn(150);
	}

	this.leave = function( groupId )
	{
		$.post(
			'/groups/leave',
			{id: groupId},
			function () { $('#menu_leave').hide(); $('#menu_join').fadeIn(150); },
			'json'
		);
	};

	this.talkAction = function ()
    {
		var form = new Form(
			'topic_form',
			{
				validators:
				{
					topic: [validatorRequired],
					text: [validatorRequired]
				},
				success: function( response )
				{
					document.location = '/groups/talk_topic?id=' + response.id;
				}
			}
		);
    };

	this.talk_topicAction = function ()
    {
		var form = new Form(
			'message_form',
			{
				validators: { text: [validatorRequired] },
				success: function( response )
				{
					document.location = '/groups/talk_topic?id=' + response.id + '&last=1';
				}
			}
		);
    };

	this.deleteTalkMessage = function( id )
	{
		if ( confirm(this.l_confirm) )
		{
			$('#talk_message' + id).fadeOut(150);
			$.post('/groups/talk_message_delete', {id: id});
		}
	};

	this.deleteTalkTopic = function( id )
	{
		if ( confirm(this.l_confirm) )
		{
			document.location = '/groups/talk_topic_delete?id=' + id;
		}
	};

	this.addModerator = function( id )
	{
		if ( !$('#new_moderator').val() )
		{
			return;
		}

		$.post(
			'/groups/add_moderator',
			{ id: $('#new_moderator').val(), group_id: groupsController.groupId },
			function( response ) {
				$('#no_moderators').hide();
				$('#moderators').append(response); $('#new_moderator').val('');
			}
		);
	}

	this.deleteModerator = function( object )
	{
		$(object).parent().fadeOut();

		$.post(
			'/groups/delete_moderator',
			{ id: $(object).attr('rel'), group_id: groupsController.groupId }
		);
	}

	this.changeOwner = function( id, object )
	{
		if ( confirm($(object).attr('rel')) )
		{
			$.post(
				'/groups/change_owner',
				{ id: id, group_id: groupsController.groupId },
				function( response ) {
					document.location = '/group' + groupsController.groupId;
				}
			);
		}
	};

	this.newsAction = function()
	{
		this.newsForm = new Form(
			'edit_news_form',
			{
				validators: {
					text: [validatorRequired]
				},
				wait_panel: 'news_wait',
				success: function() {
					$('#news_body_' + $('#news_id').val() + ' > p').text( $('#text').val() );
					$('#news_body_' + $('#news_id').val() + ' > p').show();
					$('#edit_news_form').hide();
				}
			}
		);
	};

	this.deleteNews = function( id )
	{
		$.post(
			'/groups/delete_news',
			{id: id}
		);

		$('#news_body_' + id).fadeOut(150);
		$('#news_head_' + id).fadeOut(150);
	};

	this.editNews = function( id )
	{
		if ( $('#news_id').val() )
		{
			$('#news_body_' + $('#news_id').val() + ' > p').show();
			$('#edit_news_form').hide();
		}

		$('#news_body_' + id + ' > p').hide();
		$('#news_id').val(id);
		$('#text').val( $('#news_body_' + id + ' > p').text() );
		this.newsForm.getForm().appendTo( $('#news_body_' + id) );
		this.newsForm.getForm().show();
	};

	this.applicantApprove = function( id, object )
	{
		$('#new_applicants').html( parseInt($('#new_applicants').text()) - 1 );
		$(object).parent().fadeOut( 150 );

		$.post(
			'/groups/approve_applicant',
			{ id: id, group_id: groupsController.groupId }
		);
	};

	this.applicantCancel = function( id, object )
	{
		$('#new_applicants').html( parseInt($('#new_applicants').text()) - 1 );
		$(object).parent().fadeOut( 150 );

		$.post(
			'/groups/cancel_applicant',
			{ id: id, group_id: groupsController.groupId }
		);
	};

	this.photo_addAction = function()
	{
		$('#album_id').bind('change', function() {
			if ( $(this).val() == '-1' )
			{
				$('#album_name_pane').show();
			}
			else
			{
				$('#album_name_pane').hide();
				$('#album_name').val('');
			}
		});
	};

	this.photo_viewAction = function()
	{
		var form = new Form(
			'comment_form',
			{
				validators:
				{
					text: [validatorRequired]
				},
				success: function( response )
				{
					$('#no_comments').hide();
					$('#comments').append( response );
					form.getForm().hide( 150 );
				},
				format: 'raw'
			}
		);

		var replyForm = new Form(
			'comment_reply_form',
			{
				validators:
				{
					text: [validatorRequired]
				},
				success: function( response )
				{
					$('#no_comments').hide();
					$('#child_comments_' + replyForm.get('parent_id').val()).append( response );
					replyForm.getForm().hide();
				},
				format: 'raw'
			}
		);

		$('.comment_reply').bind('click', function(){
			replyForm.get('text').val('');
			$('#comment_reply_form').appendTo($(this).parent());
			$('#comment_reply_form').show();
			replyForm.get('parent_id').val( $(this).attr('rel') );
			replyForm.get('text').focus();
		});
    };
};