<? $message = messages_peer::instance()->get_item($id) ?>

<? $is_mine = $message['sender_id'] == session::get_user_id(); ?>
<div id="message_<?=$id?>" class="thread box_empty p10 mb10 mr10 <?=!$message['is_read'] ? 'highlight' : 'box_content'?>">
	<div class="left mr10">
		<input type="checkbox" name="messages[]" value="<?=$message['thread_id']?>"/>
	</div>
	<?=user_helper::photo($is_mine ? $message['receiver_id'] : $message['sender_id'], 's', array('class' => 'border1 left'))?>
	<div onclick="document.location='/messages/view?id=<?=$message['thread_id']?>';" class="pointer ml10" style="margin-left: 95px;">
		<div class="bold left">
			<? if ( $is_mine ) { ?>
				<?=t('Я')?> &rarr; <?=user_helper::full_name($message['receiver_id'], false)?>
			<? } else { ?>
				<?=user_helper::full_name($message['sender_id'], false)?>
			<? } ?>
		</div>
		<div class="right quiet fs11"><?=date('H:i d/m', $message['created_ts'])?></div>
		<br />
		<div class="fs11 quiet">
			<?=$message['is_read'] ? '' : '<b style="color:green;">' . t('Новое сообщение') . ':</b>'?>
			<?=htmlspecialchars(text_helper::smart_trim($message['body'], 64))?>
		</div>
	</div>
	<div class="clear"></div>
</div>