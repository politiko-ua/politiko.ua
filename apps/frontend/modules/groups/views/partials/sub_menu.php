<div class="sub_menu mt5 mb10">
	<a href="/groups" <?=$sub_menu == '/groups' ? 'class="bold"' : ''?>><?=t('Популярные')?></a>
	<a href="/groups/new" <?=$sub_menu == '/groups/new' ? 'class="bold"' : ''?>><?=t('Новые')?></a>
	<? if ( session::is_authenticated() ) { ?>
		<a href="/groups/mine" <?=$sub_menu == '/groups/mine' ? 'class="bold"' : ''?>><?=t('Мои')?></a>
	<? } ?>
	<a href="/groups/create" <?=$sub_menu == '/groups/create' ? 'class="bold"' : ''?>><?=t('Создать')?></a>
</div>