var vybory2014Controller = new function()
{
        this.hide = function()
        {
                $('.vote_social').parent().hide();
                $('.success').fadeIn();
                        
        }
        this.popup_hide = function()
        {
                $('#popup_box').hide();
                        
        }
	this.vote = function( id )
	{
                Popup.show();
		
		$.get('/vyborypresidenta2014/vote', {id: id}, function( response ) {
			Popup.setHtml(response);
			Popup.position();
                });
	};
	this.politiko_vote = function( id )
	{
		$.get('/vyborypresidenta2014/politiko', {id: id});
                $('.vote_social').parent().hide();
                $('.success').fadeIn();
	};
};