<div class="left mr10">
	<b><a href="https://<?=context::get('server')?>/help/index?Связь"><?=t('Связь с нами')?></a></b>
	<ul>
		<li><a href="https://<?=context::get('server')?>/help/index?Про_нас_пишут"><?=t('Про нас пишут')?></a></li>
		<li><a href="https://<?=context::get('server')?>/help/index?Реклама"><?=t('Реклама')?></a></li>
		<li><a title="<?=t('Партнеры')?>" href="https://<?=context::get('server')?>/help/index?Партнеры"><?=t('Партнеры')?></a></li>
		<li><a title="<?=t('Сообщить об ошибке')?>" href="https://<?=context::get('server')?>/help/bug"><?=t('Обратная связь')?></a></li>
		<? if ( session::has_credential('admin') ) { ?>
			<li><a style="color: maroon;" href="https://<?=context::get('server')?>/admin"><?=t('Администрирование')?></a></li>
		<? } ?>
	</ul>
</div>

<div class="left ml10 mr10">
	<b><a title="<?=t('Вопросы по пользованию сайтом')?>" href="https://<?=context::get('server')?>/help"><?=t('Помощь')?></a></b>
	<ul>
		<li><a href="https://<?=context::get('server')?>/help/index?Правила_поведения_на_сайте"><?=t('Правила поведения')?></a></li>
		<li><a href="https://politiko.com.ua/blogpost4659"><?=t('Правила демагога')?></a></li>
		<li><a href="https://<?=context::get('server')?>/help/index?Рекомендации"><?=t('Рекомендации')?></a></li>
	</ul>
</div>

<div class="left ml10 mr10">
	<b><?=t('Сервисы')?></b>
	<ul>
		<? /*<li><a href="https://2010.<?=context::get('server')?>/"><b><?=t('Выборы 2010')?></b></a></li>*/ ?>
		<li><a href="https://politiko.com.ua/group170"><?=t('Юридическая консультация')?></a></li>
		<li><a href="https://<?=context::get('server')?>/help/index?Календарный_План"><?=t('Календарный план')?></a></li>
		<li><a href="https://mestnye.politiko.com.ua/"><?=t('Місцеві вибори')?></a></li>	
		<li><a title="<?=t('Выборы')?> 2012" href="https://<?=context::get('server')?>/vybory2012"><?=t('Выборы')?> 2012</a></li>
	</ul>
</div>

<div class="left ml10 mr10">
	<b><?=t('Нам помагают');?></b>
	<ul>
		<li><a href="https://<?=context::get('server')?>/help/index?Меценаты"><?=t('Меценаты')?></a></li>
		<li><a href="https://<?=context::get('server')?>/help/index?Модераторы"><?=t('Модераторы')?></a></li>
		<li><a href="https://<?=context::get('server')?>/help/index?Сауна"><?=t('Сауна')?></a></li>
	</ul>
</div>

<div class="right" style="text-align:right;">
	<a rel="nofollow" href="/sign/lang?code=ua"><?=tag_helper::image('icons/flag-ua.gif', array('class' => 'vcenter', 'title' => 'Українська'))?></a>
	<a rel="nofollow" href="/sign/lang?code=ru"><?=tag_helper::image('icons/flag-ru.gif', array('class' => 'vcenter mr10', 'title' => 'Русский'))?></a>
    politiko.ua 2009...<?=date('Y')?><br /><br />
<?php
    global $sape;
    echo $sape->return_links();
?>
</div>

<div class="clear"></div>
