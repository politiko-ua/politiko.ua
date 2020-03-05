var Popup = new function()
{
	this.calculateY = function()
	{
		var clientHeight =
		document.documentElement.clientHeight > window.innerHeight
		? window.innerHeight
		: document.documentElement.clientHeight;

		return parseInt(document.documentElement.scrollTop + (clientHeight - $('#popup_box').height())/2);
	};

	this.calculateX = function()
	{
		return parseInt((document.body.clientWidth - $('#popup_box').width())/2);
	};

	this.show = function()
	{
		if ( !$('#popup_box').length )
		{
			$('body').append(
				'<div id="popup_box" class="popup_box"><div class="frame">' +
				'</div></div>'
			);
		}

		this.setHtml();
		this.position();

		$('#popup_box').fadeIn( 150 );
	};

	this.close = function( fadeTime )
	{
		if ( !fadeTime )
		{
			fadeTime = 150;
		}

		$('#popup_box').fadeOut( fadeTime );
	};

	this.setHtml = function( html )
	{
		if ( !html )
		{
			html = '<img src="https://s1.' + context.host + '/common/loading.gif" class="m10" />';
		}
		
		$('#popup_box > div').html( html );
	}

	this.position = function()
	{
		$('#popup_box').css({
			top: this.calculateY() - 100 + 'px',
			left: this.calculateX() + 'px'
		});
	};
}