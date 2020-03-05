<h1 class="column_head mr10 mt10"><a href="/messages"><?=t('Мои сообщения')?></a> &rarr; <?=t('Просмотр сообщения')?></h1>

<div class="left acenter" style="width: 28.5%;">
	<?=user_helper::photo( $thread['sender_id'] == session::get_user_id() ? $thread['receiver_id'] : $thread['sender_id'], 'p', array('class' => 'border1'))?><br />
	<?=user_helper::full_name( $thread['sender_id'] == session::get_user_id() ? $thread['receiver_id'] : $thread['sender_id'] )?>
</div>

<div class="ml10" style="margin-left: 215px;">
	<div class="aright fs11 mr10 mb10 box_content p5">
		<? if ( $thread['sender_id'] != session::get_user_id() ) { ?>
			<a href="/messages/delete?id=<?=$thread['id']?>&spam=1" class="quiet"><?=t('Это спам')?></a>
		<? } ?>
		<a href="/messages/delete?id=<?=$thread['id']?>" class="ml10 maroon"><?=t('Удалить')?></a>
	</div>
	<div id="messages"><? foreach ( $list as $message ) { include 'partials/message.php'; } ?></div>

	<div class="form_bg"><form id="reply_form" action="/messages/reply" class="m10">
		<h3 class="column_head_small"><?=t('Написать сообщение')?></h3>
		<input type="hidden" name="thread_id" value="<?=$thread['id']?>"/>
		<textarea rel="<?=t('Напишите текст сообщения')?>" style="width: 99%;" name="body"></textarea>
		<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
		<?=tag_helper::wait_panel()?>
	</form></div>
	
</div>