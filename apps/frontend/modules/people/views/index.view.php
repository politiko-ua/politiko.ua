<div class="left" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10" style="width: 62%;">
	<h1 class="column_head mt10"><?=t('Рейтинг')?></h1>

	<? if ( !$list ) { ?>
		<div class="acenter fs11 quiet m10 p10"><?=t('Тут еще никого нет')?>...</div>
	<? } else { ?>

		<? if ( $cur_type == 4 ) { ?>
			<? $sorts = array('popularity' => t('поддержке'), 'rating' => t('рейтингу') ) ?>

			<div class="box_content mb10 p5 fs11">
				<?=t('Показать по')?>
				<? foreach ( $sorts as $filter => $title ) { ?>
					<?  if ( $sort == $filter ) { ?>
						<b><?=$title?></b>
					<? } else { ?>
						<a href="/people/index?type=<?=$cur_type?>&sort=<?=$filter?>"><?=$title?></a>
					<? } ?>
				<? } ?>
			</div>
		<? } ?>

		<? foreach ( $list as $id ) { include 'partials/person.php'; } ?>
		<div class="bottom_line_d mb10"></div>
		<div class="right pager"><?=pager_helper::get_full($pager)?></div>
	<? } ?>

</div>