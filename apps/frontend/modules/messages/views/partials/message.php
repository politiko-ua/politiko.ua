<div class="mr10 mb10 p10 fs11 <?=!$message['is_read'] ? 'highlight' : ( $message['sender_id'] == session::get_user_id() ? 'box_content' : 'box_deep' ) ?>">
	<? if ( $message['sender_id'] != session::get_user_id() ) { ?>
	<?=user_helper::full_name(
		$message['sender_id'],
		true,
		array('class' => 'bold green fs11'))
	?>
	<? } else { ?>
		<span class="quiet bold">Я</span>
	<? } ?>
	<span class="quiet fs11 ml10"><?=date('H:i d/m', $message['created_ts'])?></span>
	<div class="mt5 fs12"><?=nl2br(htmlspecialchars($message['body'])) ?></div>
	<? if ( $message['attached'] ) { ?>
		<div class="top_line_2 mt10 mb10 p10"><?=$message['attached']?></div>
	<? } ?>
</div>