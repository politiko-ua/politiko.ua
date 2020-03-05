<h3 class="column_head"><?=tag_helper::image('common/comments.png', array('class' => 'vcenter'))?> <?=t('Комментарии')?></h3>

<div class="mt10 mb10" id="comments">
	<? if ( !$comments ) { ?>
		<div id="no_comments" class="acenter fs11 quiet"><?=t('Нет комментариев')?></div>
	<? } else { ?>
		<? foreach ( $comments as $id ) { include 'partials/comment.php'; } ?>
	<? } ?>
</div>

<? if ( session::is_authenticated() ) { ?>
	<form class="form_bg" id="comment_form" action="/comments/add">
		<h3 class="column_head_small mb5"><?=t('Добавить комментарий')?></h3>
		<div class="ml10 mr10 mb10">
			<input type="hidden" name="oid" value="<?=$oid?>"/>
			<input type="hidden" name="otype" value="<?=$otype?>"/>
			<textarea rel="<?=t('Напишите текст')?>" style="width: 99%; height: 75px;" name="text"></textarea>
			<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
			<?=tag_helper::wait_panel()?>
		</div>
	</form>

	<form id="comment_reply_form" class="hidden" action="/comments/add">
		<input type="hidden" name="oid" value="<?=$oid?>"/>
		<input type="hidden" name="otype" value="<?=$otype?>"/>
		<input type="hidden" name="parent_id"/>
		<textarea rel="<?=t('Напишите текст')?>" style="width: 99%; height: 50px;" name="text"></textarea>
		<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
		<?=tag_helper::wait_panel()?>
		<input type="button" class="button_gray" value="<?=t('Отмена')?>" onclick="$('#comment_reply_form').hide();">
	</form>
<? } else { ?>
	<?=user_helper::login_require( t('Войдите на сайт, что-бы оставить комментарий') )?>
<? } ?>