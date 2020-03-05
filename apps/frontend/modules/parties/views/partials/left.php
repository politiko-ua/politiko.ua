<h1 class="column_head"><?=t('Направления')?></h1>
<div class="p10 mt5 acenter box_content">
	<? foreach ( $directions as $direction_data ) { ?>
		<? $name = political_views_peer::get_name($direction_data['direction']); ?>
		<a href="/parties/index?direction=<?=htmlspecialchars($name)?>" style="<?= $name==$direction ? 'color: #772f23; text-decoration: none;' : ''?>font-size: <?=9+$direction_data['weight']?>px; margin: 1px;"><?=$name?></a>
	<? } ?>
</div>

<br />
<div class="column_head">
	<h1 class="left"><?=t('Программы')?></h1>
	<a href="/parties/programs" class="mt10 fs11 right"><?=t('Все')?></a>
	<div class="clear"></div>
</div>
<div class="p10 box_content fs12">
	<ul class="mb5">
		<? foreach ( ideas_peer::get_segments() as $id => $title ) { ?>
			<li><a href="/parties/programs?segment=<?=urlencode($title)?>"><?=$title?></a></li>
			<? if ( ++$segment_index >= 5 ) break; ?>
		<? } ?>
	</ul>
	<a href="/parties/programs" style="margin-left: 17px;" class="mt10 fs11"><?=t('Все сегменты')?> &rarr;</a>
</div>

<? load::view_helper('party') ?>

<h1 class="column_head mt10">
        <span class="left"><?=t('Партии и группы')?></span>
        <a class="right fs11" href="/blogs/social_news"><?=t('Все')?></a>
        <div class="clear"></div>
</h1>

<? foreach ( $news as $id ) { $data = parties_news_peer::instance()->get_item($id); ?>
        <div class="mb10 p10 box_content fs12">
                <span class="quiet fs11"><?=date('H:i', $data['created_ts'])?></span>
                <a href="<?=$data['group_id'] ? '/groups/newsread?id=' . $data['id'] : '/parties/newsread?id=' . $data['id']?>">
                        <?=text_helper::smart_trim($data['text'], 48)?>
                </a>
                <br/>

                <div class="quiet fs10"> <?=t('Партия')?> <?=party_helper::title($data['party_id']);?> </div>
        </div>
<? } ?>

<br />
<h1 class="column_head"><?=t('Статистика')?></h1>
<div id="direction_graph" class="acenter m10 fs11 quiet"><?=t('Секунду, график грузится')?>...</div>
