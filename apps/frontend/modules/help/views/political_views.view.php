<h1 class="column_head mt10 mr10"><?=t('Политические взгляды')?></h1>
<div class="mr10">
	<? if ( !$result ) { ?>
		<p>
			<?=t('Эта страница поможет Вам определиться со своими политическими взглядами.')?>
			<?=t('После каждого утверждения или вопроса Вы найдете несколько вариантов, из которых Вам предлагается выбрать наиболее подходящий с Вашей точки зрения.')?>
			<?=t('После окончания теста, Вы сможете узнать, к какому политическому течению наиболее близки Ваши личные взгляды. Вы можете пропустить некоторые вопросы, но постарайтесь дать ответы на все, что-бы получить наиболее точные результаты.')?>
		</p>

		<form method="post">
			<? foreach ( $questions as $i => $question ) { ?>
				<div class="p5 bold box_highlight"><?=$i?>. <?=$question?></div>
				<div class="mb10">
				<? foreach ( $answers[$i] as $k => $answer ) { ?>
					<div class="answer pointer fs12 p5">
						<? $answer_id = md5($hash . $i . $k) ?>
						<input type="radio" name="question[<?=$i?>]" value="<?=$answer_id?>">
						<?=$answer?>
					</div>
				<? } ?>
				</div>
			<? } ?>

			<div class="acenter mt10">
				<input type="submit" name="submit" class="button" value=" <?=t('Узнать')?> " />
			</div>

		</form>
	<? } else { ?>
		<p>
			<?=t('Спасибо! Исходя из Ваших ответов, политическое направление, к которому Вы можете быть наиболее склонны, это:')?>
		</p>
		<div class="success acenter bold">
			<?=political_views_peer::get_name($winner)?>
			<div class="fs11 normal"><?=t('Соответствие Вашим взглядам')?>: <?=floor($winner_count/19*100)?>%</div>
		</div>

		<? if ( count($result) > 1 ) { ?>
			<p class="mb5"><?=t('Статистика по остальным направлениям')?>:</p>
			<ul class="fs12">
				<? foreach ( $result as $political_view => $count ) if ( $political_view != $winner ) { ?>
					<li class="mb5"><?=political_views_peer::get_name($political_view)?>:
					<b><?=floor($count/19*100)?>%</b></li>
				<? } ?>
			</ul>

			<div class="acenter">
				<a href="/help/political_views"><?=t('Пройти тест еще раз')?></a>
			</div>
		<? } ?>

	<? } ?>
</div>

<br />