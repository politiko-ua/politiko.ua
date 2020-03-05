(function($) {
$.fn.floatingHint = function(html, options) {
	options = $.extend({}, floatHintHandle.defaults, options);

	if ( html )
	{
		options.html = html;
	}

	this.each(function(){
		floatHintHandle(this,options);
	});
	
	return this;
}

var floatHintHandle = function(element, options) {

	if ( !$('#floating_hint').length )
	{
		var cornerHtml = '';

		var hintHtml =
			'<div style="display: none; color: maroon; background: #F5EBE5; border: 1px solid #E6CDC1; padding: 3px 5px 3px 5px; font-size: 11px;" id="floating_hint">' +
				'<span></span>' +
			'</div>';

		$('body').append( hintHtml );
	}

	$('#floating_hint > span').html( options.html ? options.html : $(element).attr('rel') );

	if ( options.position == 'right' )
	{
		$('#floating_hint').css({
			position: 'absolute',
			left: (
				$(element).position().left +
				parseInt($(element).css('margin-left'))
			) + 'px',
			top: ( $(element).position().top - 30 ) + 'px'
		});
	}
	else if ( options.position == 'top' )
	{
		$('#floating_hint').css({
			position: 'absolute',
			left: ( $(element).position().left ) + 'px',
			top: ( $(element).position().top - $('#floating_hint').height() - 25 ) + 'px'
		});
	}

	$('#floating_hint').fadeIn( options.appear );
	setTimeout(function() { $('#floating_hint').fadeOut(250); } , options.timeout);
};

floatHintHandle.defaults = {
	appear: 150,
	html: '',
	position: 'right',
	timeout: 2000
};

})(jQuery);