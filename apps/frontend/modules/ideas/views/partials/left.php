<h1 class="column_head"><?=t('Сегменты')?></h1>
<div class="mb10 mt5 acenter">
	<? foreach ( $segments as $tag_data ) { ?>
		<? $name = ideas_peer::get_segment_name($tag_data['segment']); ?>
		<a href="/ideas/index?segment=<?=urlencode($name)?>" style="<?= $name==$segment ? 'color: #772f23; text-decoration: none;' : ''?>font-size: <?=9+$tag_data['weight']?>px; margin: 1px;"><?=$name?></a>
	<? } ?>
</div>

<br />
<h1 class="column_head"><?=t('Обсуждаемые')?></h1>
<? foreach ( $discussed as $id ) { ?>
	<? $idea = ideas_peer::instance()->get_item($id) ?>
	<div  style="background:#F7F7F7;" class="p10 mb10">
		<div class="left fs11" style="margin-top: 3px;"><?=date('H:i', $idea['created_ts'])?></div>
		<div class="left ml10" style="width: 165px;">
			<a href="/idea<?=$id?>" class="fs12"><?=htmlspecialchars($idea['title'])?></a>
			<div class="fs11"><?=user_helper::full_name($idea['user_id'], true, array('class' => 'quiet'))?></div>
		</div>
		<div class="clear"></div>
	</div>
<? } ?>