<div class="box_empty box_content left p10 mb10 mr10" style="width: 45.2%;">
	<?=user_helper::photo($id, 't', array('class' => 'border1 left'), true)?>
	<div style="margin-left: 87px;">
		<div style="height: 55px;">
			<b><?=user_helper::full_name($id)?></b><br />
			<? $friend = user_auth_peer::instance()->get_item($id) ?>
			<span class="fs11 quiet"><?=user_auth_peer::get_type($friend['type'])?></span>
		</div>
		<div class="fs11">
			<a href="/messages/compose?user_id=<?=$id?>"><?=t('Написать')?></a>
		</div>
	</div>
	<div class="clear"></div>
</div>