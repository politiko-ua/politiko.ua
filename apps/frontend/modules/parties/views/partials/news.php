<? $news = parties_news_peer::instance()->get_item($id) ?>

<div class="mb10 bottom_line_d" id="news_<?=$id?>">
	<div class="left fs11 quiet acenter">
		<?=date_helper::human($news['created_ts'])?>
		<br /><br />
		<a title="Удалить новость" href="javascript:;" onclick="partiesController.deleteNews(<?=$id?>)"><?=tag_helper::image('icons/delete.png')?> <?=t('Удалить')?></a>
	</div>
	<div class="left ml10 fs12" style="width: 550px;"><?=nl2br(htmlspecialchars($news['text']))?></div>
	<div class="clear"></div><br />
</div>