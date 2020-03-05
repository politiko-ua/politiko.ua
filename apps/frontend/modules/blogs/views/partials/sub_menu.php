<div class="sub_menu mt5 mb10">
	<a href="/blogs" <?=$sub_menu == '/blogs' ? 'class="bold"' : ''?>><?=t('Эфир')?></a>
	<a href="/blogs/news" <?=$sub_menu == '/blogs/news' ? 'class="bold"' : ''?>><?=t('Новости')?></a>
	<a href="/blogs/favorites" <?=$sub_menu == '/blogs/favorites' ? 'class="bold"' : ''?>><?=t('Избранное')?></a>
	<a href="/blogs/discussed" <?=$sub_menu == '/blogs/discussed' ? 'class="bold"' : ''?>><?=t('Обсуждаемые')?></a>
	<a href="/blogs/comments" <?=$sub_menu == '/blogs/comments' ? 'class="bold"' : ''?>><?=t('Комментарии')?></a>

	<? if ( session::is_authenticated() ) { ?>
		<a href="/blog-<?=session::get_user_id()?>" <?=$sub_menu == '/blog-mine' ? 'class="bold"' : ''?>><?=t('Мой блог')?></a>
		<a href="/blogs/edit" <?=$sub_menu == '/blogs/edit' ? 'class="bold"' : ''?>><?=t('Написать')?></a>
	<? } ?>
</div>