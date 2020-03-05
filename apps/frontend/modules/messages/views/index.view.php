<h1 class="column_head mt10 mr10">
	<span class="left"><?=t('Cообщения')?></span>
	<a class="right fs11" href="/messages/compose"><?=t('Написать сообщение')?></a>
	<div class="clear"></div>
</h1>

<form id="messages_form">
	<? foreach ( $list as $id ) { include 'partials/thread.php'; } ?>
</form>

<div class="bottom_line_d mb10 mr10"></div>
<? if ( $list ) { ?>
	<div class="left">
		<input id="bulk_delete" rel="<?=t('Вы уверены?')?>" class="button" type="button" onclick="messagesController.bulkDelete();" value="<?=t('Удалить')?>"/>
		<a href="javascript:;" onclick="messagesController.markAsRead();" class="dotted fs11 ml10"><?=t('Отметить прочитанными')?></a>
	</div>
<? } ?>
<div class="right mr10 pager"><?=pager_helper::get_full($pager)?></div>