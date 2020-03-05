<h1 class="column_head mt10 mr10">
	<a href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
	&rarr;
	<a href="/parties/news?id=<?=$party['id']?>"><?=t('Новости')?></a>
</h1>



<div class="ml5 fs11 quiet mb5">
	<?=date_helper::human($item['created_ts'], ', ')?>
</div>

<div class="mr10">
	<p><?=nl2br(htmlspecialchars($item['text']))?></p>
	<? load::view_helper('comments'); ?>
	<?= comments_helper::render($item['id'], comments_helper::TYPE_PARTY_NEWS); ?>
</div>