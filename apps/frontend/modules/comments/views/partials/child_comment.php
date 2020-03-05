<? if ( !$child_comment = comments_peer::instance()->get_item($child_id) ) { return; } ?>
<div class="fs11 mt10 p5" style="border: 1px solid #E4E4E4; background: #F9F9F9;">
	<? $do_hide_comment = $child_comment['rate'] <= -5; ?>

	<div class="comment_hdata<?=$child_comment['id']?> left <?=$do_hide_comment ? 'hidden' : ''?>">
		<?=user_helper::photo($child_comment['user_id'], 's', array('class' => 'border1'))?>
	</div>

	<div style="margin-left: 60px;">
		<div class="left quiet">
			<?=user_helper::full_name($child_comment['user_id'])?> &nbsp;
			<?=date('H:i', $child_comment['created_ts'])?>
			<? if ( $do_hide_comment ) { ?>
				<a href="javascript:;" onclick="$('.comment_hdata<?=$child_comment['id']?>').show();" class="dotted ml10"><?=t('Показать')?></a>
			<? } ?>
		</div>
		<div class="right">
			<? if ( session::is_authenticated() && !comments_peer::instance()->has_rated($child_comment['id'], session::get_user_id()) ) { ?>
				<span>
					<a href="javascript:;" onclick="Comments.rate(this, <?=$child_comment['id']?>, true);"><?=tag_helper::image('common/up.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
					<a href="javascript:;" onclick="Comments.rate(this, <?=$child_comment['id']?>, false);"><?=tag_helper::image('common/down.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
				</span>
			<? } ?>
			<span class="bold mr10" style="color:<?=$child_comment['rate'] >= 0 ? $child_comment['rate'] > 0 ? 'green' : '#999' : 'red' ?>"><?=$child_comment['rate'] > 0 ? '+' : ''?><?=$child_comment['rate']?></span>
		</div>
		<br />
		<div class="mt10 comment_hdata<?=$child_comment['id']?> fs12 <?=$do_hide_comment ? 'hidden' : ''?>">
			<?=nl2br(htmlspecialchars($child_comment['text']))?>
		</div>
		
		<? if ( session::has_credential('moderator') ||
			( $child_comment['user_id'] == session::get_user_id() ) ) { ?>
			<br /><a href="javascript:;" onclick="if ( confirm('Точно?') ) { $(this).parent().parent().hide(); $.get('/comments/delete?id=<?=$child_comment['id']?>') } " class="dotted"><?=t('Удалить')?></a>
		<? } ?>
	</div>
	<div class="clear"></div>
</div>