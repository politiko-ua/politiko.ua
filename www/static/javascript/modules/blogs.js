var blogsController = new function()
{
	this.editAction = function ()
    {
		$('#mention').autocomplete({cache: false, minchars: 2, noresults: ' - ', ajax_get: function( key, cont ) { $.post(
			'/search/get_users',
			{key: key},
			function( r ) {
				var res = [];
				for( var i = 0; i < r.length; i ++ ) res.push({ id: r[i].user_id , value: r[i]['first_name'] + ' ' + r[i]['last_name'] , info: r[i]['details']});
				cont(res);
			},
			'json');
		}, callback: function( data ) {
			$('#mention').val('');
			blogsController.addMentioned(data.id, data.value);
		}});

		for ( var i = 0; i < this.mentioned.length; i++ )
		{
			this.addMentioned( this.mentioned[i]['id'], this.mentioned[i]['full_name'] );
		}
    };

	this.addMentioned = function( id, fullName )
	{
		$('#mentions').append('<span><input type="hidden" name="mentioned[]" value="' + id + '"><a target="_blank" href="/profile-' + id + '" class="mr5">' + fullName + '</a><a class="maroon" href="javascript:;" onclick="$(this).parent().remove();">x</a></span>');
	};

	this.vote = function( positive )
	{
		$('#vote_pane').fadeOut(100);
           if(positive)
		$.post(
			'/blogs/vote',
			{id: blogsController.postId, positive: positive ? 1 : 0},
			function () {
				var voteDisplay = $('#vote_value').children( positive ? '.green' : '.red' );
				voteDisplay.html( parseInt(voteDisplay.text()) + 1 );
			}
		);
           else
               {
                   $('input[name="neg_msg"]').val(1);
                   $('#cancel_v').show('slow');
                   $('#comment_form').css('background-color','#ffeeee');
                   $('#comment_add_header').css('background','url("static/images/common/down.gif") no-repeat 540px 5px scroll');
                   $('#comment_add_header').css('line-height','33px');
               }
	};

	this.rateComment = function( object, id, positive )
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
			'/blogs/comment_rate',
			{id: id, positive: positive ? 1 : 0}
		);
	};

	this.postAction = function ()
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
                
                $('.soc_share_a').bind('click', function(){
			
                        var shareLink = $(this).attr('rel');
                        var socType = $(this).attr('id');
                        $.post(
                                '/blogs/soc_share',
                                {id: blogsController.postId, type: socType},
                                function () {
                                        var socCounter = parseInt($('#'+socType+'_counter').html());
                                        $('#'+socType+'_counter').html(socCounter+1)
                                        window.open(shareLink,"","width=600,height=400,left=200,top=100,status=yes,toolbar=no,menubar=no")
                                }
                        );
                            
		});
    };
}; 
$(function(){
    $('#cancel_v').click(function(){
        $('input[name="neg_msg"]').val(0);
        $('comment_form').css('background-color','#F7F7F7');
        $('#comment_add_header').css('background','url("static/images/common/box_head_tiny.gif") no-repeat 0 0 scroll');
        $('#comment_add_header').css('line-height','20px');
        $('#vote_pane').fadeIn(100);
        $(this).hide();
    });
});