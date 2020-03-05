<? $party = parties_peer::instance()->get_item($id) ?>

<div class="mb10 box_content p10">
	<div class="left"><?=party_helper::photo($party['id'], 't', true, array('class' => 'border1'))?></div>
	<div style="margin-left: 90px;">
		<a class="bold" href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>

		<? $rate_offset = ceil( $party['rate'] ) + 2 ?>
		<div class="rate mt5"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Рейтинг')?>: <?=number_format($party['rate'], 2)?></div></div>

		<div class="fs11 mt5">
			<span class="right"><?=t('Поддерживают')?>: <b><?=$party['trust']?></b></span>
			<a class="left" href="/parties/index?direction=<?=political_views_peer::get_name($party['direction'])?>"><?=political_views_peer::get_name($party['direction'])?></a>
			<div class="clear"></div>
		</div>
	</div>
</div>
