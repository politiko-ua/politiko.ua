<h1 class="column_head mt10 mr10">
	<span class="left"><?=t('Закладки')?></span>
	<div class="clear"></div>
</h1>

<? foreach ( $list as $item ) { include 'partials/item_' . $item['type'] . '.php'; } ?>

<div class="bottom_line_d mb10 mr10"></div>
<br/><br />