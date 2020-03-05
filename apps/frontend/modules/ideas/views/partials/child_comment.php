<? if ( !$child_comment = ideas_comments_peer::instance()->get_item($child_id) ) { return; } ?>
<div class="fs11 mt10 p5" style="border: 1px solid #E4E4E4; background: #F9F9F9;">
	<?=user_helper::photo($child_comment['user_id'], 's', array('class' => 'border1 left'))?>
	<div style="margin-left: 60px;">
		<?=user_helper::full_name($child_comment['user_id'])?>
		<span class="quiet ml10"><?=date('H:i', $child_comment['created_ts'])?></span><br />
		<?=nl2br(htmlspecialchars($child_comment['text']))?>
		<? if ( session::has_credential('moderator') ) { ?>
			<br /><a href="javascript:;" onclick="if ( confirm('Точно?') ) { $(this).parent().parent().hide(); $.get('/blogs/delete_comment?id=<?=$child_comment['id']?>') } " class="dotted"><?=t('Удалить')?></a>
		<? } ?>
	</div>
	<div class="clear"></div>
</div>