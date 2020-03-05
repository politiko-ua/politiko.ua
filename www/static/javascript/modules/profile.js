var profileController = new function()
{
	this.editAction = function ()
    {
		var commonForm = new Form(
			'common_form',
			{
				validators: {
					first_name: [validatorRequired],
					last_name: [validatorRequired]
				},
				success: function() {
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
				},
				wait_panel: 'common_wait'
			}
		);

		var settingsForm = new Form(
			'settings_form',
			{
				validators: {
					email: [validatorEmail],
					new_password: function() {
						if ( settingsForm.get('new_password').val() != '' )
						{
							if ( settingsForm.get('new_password_confirm').val() != settingsForm.get('new_password').val() )
							{
								return true;
							}
						}
							
						return false;
					}
				},
				success: function()
				{
					$('.success').fadeIn( 250, function() { $('.success').fadeOut( 1500 ); } );
				},
				wait_panel: 'settings_wait'
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

		$('.tab_menu').click(function() {
			$('.tab_menu').removeClass('selected');
			$(this).addClass('selected');
			$(this).blur();
			$('.form').hide();
			$('#' + $(this).attr('rel') + '_form').show();
		});

		$('#tab_' + this.defaultTab).click();

		commonForm.get('city').autocomplete({cache: false, minchars: 2, noresults: 'Неизвестный город', ajax_get: function( key, cont ) { $.post(
			'/profile/get_city',
			{key: key},
			function( r ) {
				var res = [];
				for( var i = 0; i < r.length; i ++ ) res.push({ id: r[i].id , value: r[i]['name_' + context.language] , info: r[i]['region_name_' + context.language]});
				cont(res);
			},
			'json');
		}, callback: function( data ) { commonForm.get('city_id').val(data.id); }});

		commonForm.get('political_views_custom').autocomplete({
			get : function( key ) {
				var res = [];
				for ( var id in profileController.politicalViewsOther )
				{
					if ( profileController.politicalViewsOther[id].toLowerCase().indexOf(key.toLowerCase()) >= 0 )
					{
						res.push({id: id, value: profileController.politicalViewsOther[id]});
					}
				}

				return res;
			},
			cache: false, delay: 50, minchars: 1, noresults: '-'
		});

		this.switchPoliticalViews();
		$('#political_views_sub').val( profileController.userPoliticalViewsSub );
    };

	this.switchPoliticalViews = function()
	{
		if ( $('#political_views').val() == 5 )
		{
			$('#political_views_sub').hide();
			$('#political_views_custom').show();
		}
		else
		{
			$('#political_views_sub').html('');
			$('#political_views_custom').hide();

			if ( this.politicalViewsSub[$('#political_views').val()] )
			{
				$('#political_views_sub').addOption( this.politicalViewsSub[$('#political_views').val()] );
			}
			$('#political_views_sub').html() ? $('#political_views_sub').show() : $('#political_views_sub').hide();
		}
	};

	this.trust = function( id, trust )
	{
		$('#trust_wait').show();
		$.post(
			'/profile/trust',
			{id: id, trust: trust ? 1 : 0},
			function() {
				$('#trust_wait').hide();

				$('.custom_rate_selected').removeClass('custom_rate_selected');
				$('#' + ( trust ? 'trust' : 'not_trust' ) ).addClass('custom_rate_selected');

				if ( trust )
				{
					$('#trust_value').html( parseInt($('#trust_value').html()) + 1 );
				}
				else
				{
					$('#not_trust_value').html( parseInt($('#not_trust_value').html()) + 1 );
				}
			},
			'json'
		);
	};

	this.indexAction = function()
	{
		$('.tab_pane > a').bind('click', function() {
			$('.tab_pane > a').removeClass('selected');
			$(this).addClass('selected');
			$('.content_pane').hide();
			$('#pane_' + $(this).attr('rel')).show();
			$(this).blur();
		});

		var askForm = new Form(
			'ask_form',
			{
				validators:
				{
					text: [validatorRequired]
				},
				success: function( response )
				{
					$('#no_question').hide();
					$('#quesiton_success').fadeIn( 150 );
					$('#ask_form').hide();
				},
				wait_panel: 'ask_wait'
			}
		);

		swfobject.embedSWF(
			'/chart.swf',
			'rate_history',
			450,
			200,
			'9.0.0',
			'expressInstall.swf',
			{'data-file': '/profile/rate_history?id=' + profileController.profileId},
			{wmode: 'transparent'}
		);
	};

	this.questionsAction = function()
	{
		var askForm = new Form(
			'ask_form',
			{
				validators:
				{
					text: [validatorRequired]
				},
				success: function( response )
				{
					$('#question_success').fadeIn( 150 );
				},
				wait_panel: 'ask_wait'
			}
		);

		var replyForm = new Form(
			'question_reply_form',
			{
				validators:
				{
					reply: [validatorRequired]
				},
				success: function( response )
				{
					$('#reply_' + replyForm.get('id').val()).append( response );
					replyForm.getForm().hide();
				},
				format: 'raw',
				wait_panel: 'reply_wait'
			}
		);

		$('.question_reply').bind('click', function(){
			$('#question_reply_form').appendTo($(this).parent());
			$('#question_reply_form').show();
			replyForm.get('id').val( $(this).attr('rel') );
		});
	};

	this.rateQuestion = function( object, id, positive )
	{
		$(object).parent().fadeOut(150);

		var rateEl = $(object).parent().parent().children('span.bold');
		var newRate = parseInt(rateEl.html()) + (positive ? 1 : -1);

		if ( newRate > 0 )
		{
			newRate = '+' + newRate;
			rateEl.css({color: 'green'});
		}
		else
		{
			rateEl.css({color: 'red'});
		}

		rateEl.html( newRate );

		$.post(
			'/profile/question_rate',
			{id: id, positive: positive ? 1 : 0}
		);
	};

	this.deleteProfile = function()
	{
		Popup.show();
		$.get('/profile/delete', function(response) { Popup.setHtml(response); Popup.position(); });
	}

	this.unBan = function( id )
	{
		$('#banned_' + id).fadeOut( 150 );
		$.post('/friends/unban', {id: id});
	}
};
