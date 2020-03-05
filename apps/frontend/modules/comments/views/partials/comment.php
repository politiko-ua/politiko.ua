<? $comment = comments_peer::instance()->get_item($id) ?>
<div class="mb10 comment_bg" id="comment<?=$id?>">
	<? $do_hide_comment = $comment['rate'] <= -5; ?>

	<div class="comment_hdata<?=$comment['id']?> left <?=$do_hide_comment ? 'hidden' : ''?>">
		<?=user_helper::photo($comment['user_id'], 's', array('class' => 'border1'))?>
	</div>

	<div class="left ml10" style="width: 525px;">
		<div class="fs11 pb5">
			<div class="left">
				<?=user_helper::full_name($comment['user_id'])?>
				<span class="quiet ml10"><?=date('H:i', $comment['created_ts'])?></span>
				<? if ( $do_hide_comment ) { ?>
					<a href="javascript:;" onclick="$('.comment_hdata<?=$comment['id']?>').show();" class="dotted ml10"><?=t('Показать')?></a>
				<? } ?>
			</div>
			<div class="right">
				<? if ( session::is_authenticated() && !comments_peer::instance()->has_rated($id, session::get_user_id()) ) { ?>
					<span>
						<a href="javascript:;" onclick="Comments.rate(this, <?=$comment['id']?>, true);"><?=tag_helper::image('common/up.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
						<a href="javascript:;" onclick="Comments.rate(this, <?=$comment['id']?>, false);"><?=tag_helper::image('common/down.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
					</span>
				<? } ?>
				<span class="bold mr10" style="color:<?=$comment['rate'] >= 0 ? $comment['rate'] > 0 ? 'green' : '#999' : 'red' ?>"><?=$comment['rate'] > 0 ? '+' : ''?><?=$comment['rate']?></span>
			</div>
			<div class="clear"></div>
		</div>

		<div class="comment_hdata<?=$comment['id']?> fs12 <?=$do_hide_comment ? 'hidden' : ''?>"><?=nl2br(htmlspecialchars($comment['text']))?></div>
		<div id="child_comments_<?=$comment['id']?>">
			<? $childs = explode(',', $comment['childs']); foreach ( $childs as $child_id ) { if ( $child_id = (int)$child_id ) { ?>
					<? include dirname(__FILE__) . '/child_comment.php'; ?>
			<? } } ?>
		</div>

		<div class="comment_hdata<?=$comment['id']?> fs11 mb5 mt5 <?=$do_hide_comment ? 'hidden' : ''?>">
			<? if ( session::is_authenticated() ) { ?>
				<a href="javascript:;" rel="<?=$comment['id']?>" class="dotted comment_reply"><?=t('Ответить')?></a>
			<? } ?>
			<? if ( session::has_credential('moderator') ||
				( ( $comment['user_id'] == session::get_user_id() ) && !$comment['childs'] ) ) { ?>
				<a href="javascript:;" onclick=" if ( confirm('Точно?') ) { $(this).parent().parent().parent().hide(); $.get('/comments/delete?id=<?=$comment['id']?>') } " class="dotted ml10"><?=t('Удалить')?></a>
			<? } ?>
		</div>
	</div>
	<div class="clear"></div>
</div>