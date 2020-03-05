var signController = new function()
{
    this.indexAction = function ()
    {
		Application.initSignInForm();
    };

	this.upAction = function ()
    {
		var form = new Form(
			'signup_form',
			{
				validators:
				{
					'first_name': [validatorRequired],
					'last_name': [validatorRequired],
					'email': [validatorRequired, validatorEmail],
					/*'code': [validatorRequired],*/
					'password': [validatorRequired],
					'password_confirm' : function ( value ) { return ( value != form.get('password').val() ) }
				},
				success: function()
				{
					form.getForm().hide();
					$('.success').fadeIn();
				}
			}
		);

		form.get('first_name').focus();

		form.get('political_views_custom').autocomplete({
			get : function( key ) {
				var res = [];
				for ( var id in signController.politicalViewsOther )
				{
					if ( signController.politicalViewsOther[id].toLowerCase().indexOf(key.toLowerCase()) >= 0 )
					{
						res.push({id: id, value: signController.politicalViewsOther[id]});
					}
				}

				return res;
			},
			cache: false, delay: 50, minchars: 1, noresults: '-'
		});
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

	this.selectPolitics = function( selector )
	{
		$(selector).val() == 'other' ? $('#politics_custom_pane').show() : $('#politics_custom_pane').hide();
	};

	this.passwordAction = function ()
    {
                var form = new Form(
                        'change_password_form',
                        {
                                validators:
                                {
                                        'password': [validatorRequired],
                                        'password_confirm' : function ( value ) { return ( value != form.get('password').val() ) }
                                },
                                success: function()
                                {
                                        $('.success').fadeIn( 150 );
                                },
                                error_position: 'top'
                        }
                );
    };

	
	this.recoverAction = function ()
    {
                var form = new Form(
                        'recover_form',
                        {
                                validators:
                                {
                                        'email': [validatorRequired, validatorEmail]
                                },
                                success: function()
                                {
                                        $('.success').fadeIn( 150 );
                                },
                                error_position: 'top'
                        }
                );
    };
};
