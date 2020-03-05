<div class="left" style="width: 60%;">
	<h1><?=t('Выборы 2010') ?></h1>

	<ul class="candidates">
		<? foreach ( $list as $id ) { ?>
			<li id="candidate<?=$id?>">
				<?=user_helper::photo($id, 'mm', array(), false)?>
				<div>
					<h2><?=user_helper::full_name($id, false)?></h2>
					<a target="_blank" href="<?=user_helper::profile_link($id)?>"><?=t('Профиль')?></a>
				</div>
			</li>
		<? } ?>
	</ul>

	<div class="clear"></div><br />

</div>

<div class="right" style="width: 35%;">
	<? $tag = 'Выборы'; load::model('blogs/posts'); load::model('blogs/posts_tags'); load::model('blogs/tags') ?>
	<h1><a href="https://<?=context::get('server')?>/blogs/index?tag=<?=$tag?>"><?=t('Новости')?></a></h1>
	<div>
		<? if ( $news = blogs_posts_peer::instance()->get_by_tag( blogs_tags_peer::instance()->get_by_name( $tag ) ) ) foreach ( $news as $id ) { ?>
			<? $post_data = blogs_posts_peer::instance()->get_item($id) ?>
				<div style="background:#F7F7F7;" class="p5 mb10">
					<div class="left fs11" style="margin-top: 3px;"><?=date('H:i', $post_data['created_ts'])?></div>
					<div class="left ml10" style="width: 280px;">
						<a class="<?=$post_data['rate'] > 5 ? 'bold' : ''?> fs12" href="https://<?=context::get('server')?>/blogpost<?=$id?>"><?=htmlspecialchars($post_data['title'])?></a>
						<div class="fs11"><?=user_helper::full_name($post_data['user_id'], true, array('class' => 'quiet'))?></div>
					</div>
					<div class="clear"></div>
				</div>
		<? if ($i++ >= 10) break; } ?>
	</div>

</div>

<div class="clear"></div>
<br/>
