<? $topic_message = groups_topics_messages_peer::instance()->get_item($id) ?>
<div class="mb10 comment_bg mr10" id="talk_message<?=$id?>">
	<div class="left"><?=user_helper::photo($topic_message['user_id'], 's', array('class' => 'border1'))?></div>
	<div class="left ml10" style="width: 525px;">
		<div class="fs11 pb5">
			<?=user_helper::full_name($topic_message['user_id'])?>
			<span class="quiet ml10"><?=date_helper::human($topic_message['created_ts'], ', ')?></span>
		</div>

		<div class="fs12 mt5"><?=nl2br(htmlspecialchars($topic_message['text']))?></div>

		<? if ( ( $topic_message['user_id'] == session::get_user_id() ) || groups_peer::instance()->is_moderator($group['id'], session::get_user_id()) ) { ?>
			<div class="fs10 mt10">
				<a href="javascript:;" onclick="groupsController.deleteTalkMessage(<?=$id?>);" class="maroon dotted"><?=t('Удалить')?></a>
			</div>
		<? } ?>
	</div>
	<div class="clear"></div>
</div>