<div class="sub_menu mt5 mb10">
	<a href="/ideas" <?=$sub_menu == '/ideas' ? 'class="bold"' : ''?>><?=t('Новые')?></a>
	<a href="/ideas/hot" <?=$sub_menu == '/ideas/hot' ? 'class="bold"' : ''?>><?=t('Лучшие')?></a>
	<? if (session::is_authenticated() ) { ?>
		<a href="/ideas/mine" <?=$sub_menu == '/ideas/mine' ? 'class="bold"' : ''?>><?=t('Мои')?></a>
	<? } ?>
	<a href="/ideas/create" <?=$sub_menu == '/ideas/create' ? 'class="bold"' : ''?>><?=t('Высказать идею')?></a>
</div>