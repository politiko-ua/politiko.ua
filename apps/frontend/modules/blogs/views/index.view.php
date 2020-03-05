<? $sub_menu = '/blogs'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="left" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10" style="width: 62%;">

	<div class="column_head">
		<? if ( $tag ) { ?>
			<h1 class="left"><a href="/blogs"> <?=t('Блоги')?></a> &rarr; <?=htmlspecialchars($tag)?></h1>
			<a class="right" href="/blogs/rss?tag=<?=urlencode($tag)?>"><?=tag_helper::image('icons/rss.gif', array('class' => 'mt10', 'title' => 'RSS'))?></a>
		<? } else { ?>
			<h1 class="left"> <?=t('Прямой эфир')?></h1>
			<a class="right" href="/blogs/rss"><?=tag_helper::image('icons/rss.gif', array('class' => 'mt10', 'title' => 'RSS'))?></a>
		<? } ?>
	</div>

	<? foreach ( $list as $id ) { ?>
		<? if ( !$post_data = blogs_posts_peer::instance()->get_item($id) ) continue; ?>
		<? include 'partials/post.php'; ?>
	<? } ?>

	<div class="bottom_line_d mb10" style="margin-left: 75px;"></div>
	<div class="right pager"><?=pager_helper::get_full($pager)?></div>

</div>
