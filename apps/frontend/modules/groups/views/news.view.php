<h1 class="column_head mt10 mr10">
	<a href="/group<?=$group['id']?>"><?=htmlspecialchars($group['title'])?></a>
	&rarr;
	<?=t('Новости')?>
</h1>

<div class="mr10">

	<? if ( !$list ) { ?>
		<div class="screen_message acenter"><?=t('Новостей еще нет')?></div>
	<? } ?>

	<? foreach ( $list as $id ) { ?>
		<? $news_item = groups_news_peer::instance()->get_item($id); ?>
		<div id="news_head_<?=$id?>" class="mb5 quiet fs11 box_content p5">
			<?=date_helper::human($news_item['created_ts'], ', ')?>
			<? if ( groups_peer::instance()->is_moderator($group['id'], session::get_user_id()) ) { ?>
				<a href="javascript:;" onclick="groupsController.editNews(<?=$id?>);" class="dotted ml10"><?=t('Редактировать')?></a>
				<a href="javascript:;" onclick="if ( confirm('<?=t('Удалить новость?')?>') ) groupsController.deleteNews(<?=$id?>);" class="dotted ml10"><?=t('Удалить')?></a>
			<? } ?>
		</div>
		<div class="m10 fs12" id="news_body_<?=$id?>">
			<? $news_item['text'] = text_helper::smart_trim($news_item['text'], 256) ?>
			<p><?=nl2br(htmlspecialchars($news_item['text']))?></p>
			<a href="/groups/newsread?id=<?=$news_item['id']?>"><?=t('Читать все &rarr;')?></a>
		</div>
	<? } ?>

	<div class="bottom_line_d mb10"></div>
	<div class="right pager"><?=pager_helper::get_full($pager)?></div>
</div>

<form id="edit_news_form" class="hidden" action="/groups/save_news">
	<input type="hidden" name="news_id" id="news_id" value="">
	<textarea name="text" rel="<?=t('Введите текст')?>" id="text"></textarea>
	<div class="mt10">
		<input type="submit" class="button" name="submit" value="<?=t('Сохранить')?>">
		<input type="button" class="button_gray" onclick="$('#edit_news_form').hide(); $('#news_body_' + $('#news_id').val() + ' > p').show();" value="<?=t('Отмена')?>">
		<?=tag_helper::wait_panel('news_wait')?>
	</div>
</form>