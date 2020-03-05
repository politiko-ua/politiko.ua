var adminController = new function()
{
	this.indexAction = function()
	{
		swfobject.embedSWF(
			'/chart.swf',
			'user_stats',
			425,
			350,
			'9.0.0',
			'expressInstall.swf',
			{'data-file': '/admin/user_stats'}
		);
	};

	this.maillistAdd = function( object )
	{
		var html = $(object).parent().parent().html();
		$(object).parent().parent().parent().append( '<tr class="maillist_item">' + html + '</tr>' );
	};

	this.maillistRemove = function( object )
	{
		if ( $('.maillist_item').length > 1 )
		{
			$(object).parent().parent().remove();
		}
	};

	this.maillistAction = function()
	{
		if ( $('#send_form').length > 0 )
		{
			var form = new Form(
				'send_form',
				{
					validators: {
						body: [validatorRequired], subject: [validatorRequired]
					},
					handle: false
				}
			);
		}
	};

	this.showMailFilter = function( filter )
	{
		$('.mfilter').hide();
		$('#' + filter + '_filter').show();
	};

	this.chageMailMode = function( mode )
	{
		$('.mail_mode').removeClass('bold');
		$('#mode_' + mode).addClass('bold');
		$('.mode_pane').hide();
		$('#pane_' + mode).show();
		$('#mail_mode').val(mode);
	}
};