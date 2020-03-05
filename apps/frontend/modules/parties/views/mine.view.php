<? $sub_menu = '/parties/mine'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="screen_message">
	<?=tag_helper::image('common/warning_b.png', array('class' => 'left mr10'))?>
	<div class="left ml10" style="width: 500px;">
		<b><?=t('Вы еще не определились с партией, в которую хотели бы вступить')?></b>
		<br /><br />

		<?=t('Определиться с выбором Вам поможет')?> <a href="/parties"><?=t('рейтинг партий')?></a>,
		<?=t('а также список')?> <a href="/parties/new"><?=t('новых партий')?></a>, <?=t('которые зарегистрировались недавно')?>.
		<br /><br />

		<? if ( $user_data['political_views'] && !in_array($user_data['political_views'], array(5,6)) ) { ?>
			<?=t('Наиболее близкие партии по Вашим политическим взглядам Вы сможете найти на этой странице')?>:<br />
			<a href="/parties/index?direction=<?=urlencode(political_views_peer::get_name($user_data['political_views']))?>"><?=t('Партии по направлению')?> &laquo;<?=political_views_peer::get_name($user_data['political_views'])?>&raquo;</a>
		<? } else { ?>
			<?=t('Вы еще не определились с политическими взглядами')?>, <a href="/help/political_views"><?=t('пройдите тест')?></a>, <?=t('который')?> <a href="/help/political_views"><?=t('поможет Вам определиться')?></a>.
		<? } ?>
	</div>
</div>
