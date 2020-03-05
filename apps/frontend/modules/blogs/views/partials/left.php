<h1 class="column_head"><?=t('Облако меток')?></h1>
<div class="p10 box_content acenter">
	<? if ( !$top_tags ) echo '<div class="fs11 quiet">Меток нет</div>'; ?>
	<? foreach ( $top_tags as $tag_data ) { ?>
		<? $name = blogs_tags_peer::instance()->get_name($tag_data['id']); ?>
		<a href="/blogs/index?tag=<?=htmlspecialchars($name)?>" style="<?= $name==$tag ? 'color: #772f23; text-decoration: none;' : ''?>; font-size: <?=9+$tag_data['weight']?>px; margin: 1px;"><?=$name?></a>
	<? } ?>
</div>

<br />
<div class="column_head">
	<h1 class="left"><?=t('Свежие записи')?></h1>
	<div class="right mt5">
		<a href="/blogs/new" class="fs11"><?=t('Все')?></a>
	</div>
	<div class="clear"></div>
</div>
<? foreach ( $newest as $id ) { ?>
	<? $post_data = blogs_posts_peer::instance()->get_item($id) ?>
		<div style="background:#F7F7F7;" class="p5 mb10">
			<div class="left fs11" style="margin-top: 3px;"><?=date('H:i', $post_data['created_ts'])?></div>
			<div class="left ml10" style="width: 180px;">
				<a class="<?=$post_data['rate'] > 5 ? 'bold' : ''?> fs12" href="/blogpost<?=$id?>"><?=htmlspecialchars($post_data['title'])?></a>
				<div class="fs11"><?=user_helper::full_name($post_data['user_id'], true, array('class' => 'quiet'))?></div>
			</div>
			<div class="clear"></div>
		</div>
<? } ?>