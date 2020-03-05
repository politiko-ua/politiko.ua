<? $sub_menu = '/parties'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="left" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10" style="width: 62%;">
	<? if ( $direction ) { ?>
		<h1 class="column_head"><a href="/parties"><?=t('Партии')?></a> &rarr; <?=htmlspecialchars($direction)?></h1>
	<? } else { ?>
		<h1 class="column_head"><?=t('Рейтинг партий')?></h1>
	<? } ?>

	<? $sorts = array('popularity' => t('поддержке'), 'rating' => t('рейтингу') ) ?>

	<div class="box_content mb10 p5 fs11">
		<?=t('Показать по')?>
		<? foreach ( $sorts as $filter => $title ) { ?>
			<?  if ( $sort == $filter ) { ?>
				<b><?=$title?></b>
			<? } else { ?>
				<a href="/parties/index?direction=<?=$direction?>&sort=<?=$filter?>"><?=$title?></a>
			<? } ?>
		<? } ?>
	</div>

	<? foreach ( $list as $id ) { include 'partials/party.php'; } ?>

	<div class="bottom_line_d mb10"></div>
	<div class="right pager"><?=pager_helper::get_full($pager)?></div>

</div>
