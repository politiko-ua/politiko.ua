<div class="content_pane" id="pane_blog">
	<div class="pl5 pt5 mb5 pb5 fs11" style="background: #F7F7F7">
		<a href="/blog-<?=$user_data['user_id']?>"><?=t('Читать весь блог')?> &rarr;</a>
		<? if ( session::get_user_id() == $user['id'] ) { ?><a class="ml10" href="/blogs/edit"><?=t('Написать')?></a><? } ?>
	</div>
	<? if ( !$blog_list ) { ?>
		<div class="screen_message quiet acenter"><?=t('В блоге еще нет записей')?></div>
	<? } ?>
	<? foreach ( $blog_list as $id ) { ?>
		<? $post_data = blogs_posts_peer::instance()->get_item($id) ?>
		<? include dirname(__FILE__) . '/../../../../blogs/views/partials/post.php'; ?>
	<? } ?>
</div>