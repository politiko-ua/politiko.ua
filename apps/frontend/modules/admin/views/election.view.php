<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Выборы')?></h1>

	<div class="box_content acenter p10 fs12">
		<? include '/var/www/politiko/data/cvk.php' ?>
		<form method="post">
			<? foreach ( $rrating as $id => $votes  ) { ?>
				<label class="fs10 quiet"><?= $id ? user_helper::full_name($id) : t('Против всех')?></label>
				<input type="text" class="text" name="votes[<?=$id?>]" value="<?=$votes?>" />
				<br />
			<? } ?>
			<br />

			<label class="fs10 quiet">Обработано бюлетеней</label>
			<input type="text" class="text" name="buletens" value="<?=$buletens?>" />

			<br />

			<input type="submit" class="button" name="submit" value="<?=t('Сохранить')?>" />
		</form>
	</div>
</div>
