<div class="left" style="width: 60%;">
	<h1><a href="/"><?=t('Выборы президента Украины 2010') ?></a> &rarr; <?=t('Результаты')?></h1>

	<div class="box_content p10 mb10 fs11 quiet">
		<?=t('Результаты онлайн голосования показываются с задержкой в 10 минут')?>
	</div>

	<ol class="candidates_results">
		<? foreach ( $rating as $line ) { ?>
			<li>
				<? if ( $line['id'] ) { ?>
					<?=user_helper::photo($line['id'], 't')?>
				<? } else { ?>
					<?=tag_helper::image('common/none.png', array('width' => 75))?>
				<? } ?>
				
				<?$percent = number_format(100*$line['votes']/$votes_total, 2)?>

				<div class="details">
					<? if ( $line['id'] ) { ?>
						<?=user_helper::full_name($line['id'])?>
					<? } else { ?>
						<?=t('Против всех')?>
					<? } ?>
					
					<b class="ml10"><?=$percent?>%</b>

					<span class="right"><?=t('количество голосов')?>: <b><?=$line['votes']?></b></span>
					<div class="clear"></div>
					
					<div class="candidate_progress" style="width: <?=( $percent > 0 ? $percent : 1 )*4.5?>px"></div>
				</div>

				<div class="clear"></div>

			</li>
		<? } ?>
	</ol>

	<div class="clear"></div><br />
</div>

<div class="right" style="width: 35%;">
	<h1>
		<?=t('Ваш выбор')?>
		<?=tag_helper::wait_panel('choice_wait')?>
	</h1>
	<div id="your_choice">
		<? if ( $my_vote ) { ?>
			<? $id = $my_vote['candidate_id']; include 'partials/my.php' ?>
		<? } else { ?>
			<?=t('Вы еще не выбрали своего кандидата. Делайте выбор слева, нажав на кнопку "Голосовать".')?>
		<? } ?>
	</div>

</div>

<div class="clear"></div>
<br/>