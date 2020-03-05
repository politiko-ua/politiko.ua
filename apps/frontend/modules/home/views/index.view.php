<div class="left" style="width: 35%;">
	<? if ( $news ) { ?>
		<h1 class="column_head mt10">
			<span class="left"><?=t('Новости')?></span>
			<a class="right fs11" href="/blogs/news"><?=t('Все')?></a>
			<div class="clear"></div>
		</h1>
		<? foreach ( $news as $id ) { ?>
			<? $data = blogs_posts_peer::instance()->get_item($id) ?>

			<div class="mb10 p10 box_content fs12">
				<span class="quiet fs11"><?=date('H:i', $data['created_ts'])?></span>
				<a href="/blogpost<?=$id?>"><?=htmlspecialchars($data['title'])?></a>
			</div>
		<? } ?>
	<? } ?>

	<? if ( $social_news ) { ?>
		<? load::view_helper('party') ?>
		<? load::view_helper('group') ?>

		<h1 class="column_head mt10">
			<span class="left"><?=t('Партии и группы')?></span>
			<a class="right fs11" href="/blogs/social_news"><?=t('Все')?></a>
			<div class="clear"></div>
		</h1>
		<? foreach ( $social_news as $data ) { ?>
			<div class="mb10 p10 box_content fs12">
				<span class="quiet fs11"><?=date('H:i', $data['created_ts'])?></span>
				<a href="<?=$data['group_id'] ? '/groups/newsread?id=' . $data['id'] : '/parties/newsread?id=' . $data['id']?>">
					<?=text_helper::smart_trim($data['text'], 48)?>
				</a>
				<br/>
				<div class="quiet fs10">
					<? if ( $data['group_id'] ) { ?>
						<?=t('Группа')?>
						<?=group_helper::title($data['group_id']);?>
					<? } else { ?>
						<?=t('Партия')?>
						<?=party_helper::title($data['party_id']);?>
					<? } ?>
				</div>
			</div>
		<? } ?>
	<? } ?>

	<h1 class="column_head mt10">
		<span class="left"><?=t('Дебаты')?></span>
		<a class="right fs11" href="/debates"><?=t('Все')?></a>
		<div class="clear"></div>
	</h1>
	<? foreach ( $new_debates as $id ) { ?>
		<? $data = debates_peer::instance()->get_item($id) ?>

		<div class="mb10 p10 box_content">
			<div class="mb5">
				<a href="/debate<?=$id?>"><?=htmlspecialchars(text_helper::smart_trim($data['text'], 128))?></a>
				<span class="fs10 quiet">(<?=user_helper::full_name($data['user_id'], false)?>)</span>
			</div>
			<div class="left acenter fs10" style="width: 60px;">
				<?=user_helper::photo($data['user_id'], 's', array('class' => 'border1'))?>
			</div>
			<div class="ml5 left" style="width: 155px;">
				<div class="fs11 mt5">
					<div class="left" style="width: 75px;"><?=tag_helper::image('common/up.gif', array('class' => 'vcenter'))?> <b><?=$data['for']?></b></div>
					<div class="left" style="width: 75px;"><?=tag_helper::image('common/down.gif', array('class' => 'vcenter'))?> <b><?=$data['against']?></b></div>
					<div class="clear"></div>
				</div>
				<div class="mt5"><a class="fs11" href="/debate<?=$data['id']?>"><?=t('Аргументы')?> &rarr;</a></div>
			</div>
			<div class="clear"></div>
		</div>
	<? } ?>

	<div class="box_content p5">
		<a class="fs11" href="/debates"><?=t('Все дебаты')?> &rarr;</a>
	</div>
</div>

<div class="left ml10" style="width: 62%;">
	<h1 class="column_head mt10">
		<span class="left"><?=t('Прямой эфир блогов')?></span>
		<a class="right fs11" href="/blogs"><?=t('Все')?></a>
		<div class="clear"></div>
	</h1>

	<? foreach ( $list as $id ) { ?>
		<? if ( !$post_data = blogs_posts_peer::instance()->get_item($id) ) continue; ?>
		<? include dirname(__FILE__) . '/../../blogs/views/partials/post.php'; ?>
	<? } ?>

	<div class="box_content p5">
		<a class="fs11" href="/blogs?page=2"><?=t('Следующие записи')?> &rarr;</a>
	</div>

</div>
