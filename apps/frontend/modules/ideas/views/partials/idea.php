<? $idea = ideas_peer::instance()->get_item($id) ?>

<div class="left"><?=user_helper::photo($idea['user_id'], 's', array('class' => 'border1'))?></div>
<div class="left ml10" style="width: 360px;">
	<a href="/idea<?=$id?>"><?=htmlspecialchars($idea['title'])?></a>
	<div class="fs11 quiet mb5 mt5">
		<?=user_helper::full_name($idea['user_id'])?> &nbsp;
		<?=date_helper::human($idea['created_ts'], ', ')?>

		<div class="fs11 mt10">
			<?=tag_helper::image('common/up.gif', array('class' => 'vcenter'))?> <?=t('Идею поддерживают')?>: <b><?=$idea['rate']?></b>
		</div>
	</div>

	<a class="fs11" href="/idea<?=$id?>"><?=t('Читать далее')?> &rarr;</a>
</div>
<div class="clear"></div><br />