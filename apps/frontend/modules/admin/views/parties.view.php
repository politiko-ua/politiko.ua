<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Партии')?></h1>

	<div class="box_content acenter p10">
		<form>
			<label class="fs10 quiet"><?=t('ID партии');?></label>
			<input type="text" class="text" name="key" value="<?=$party_key?>" />
			<input type="submit" class="button" value="<?=t('Искать')?>" />
		</form>
	</div>
	<? if ( $party_key ) { ?>
		<? if ( !$party ) { ?>
			<div class="acenter screen_message acenter"><?=t('Группа не найдена')?></div>
		<? } else { ?>
			<form method="post">
				<table class="fs12 mt10">
					<tr>
						<td width="30%"><?=t('Название')?></td>
						<td>
							<?=party_helper::title($party['id'])?><br />
							<?=party_helper::photo($party['id'], 't', true, array('class' => 'mt5'))?>
						</td>
					</tr>
					<tr>
						<td><?=t('Рейтинг')?></td>
						<td>
							<input type="text" class="text" name="rate" value="<?=$party['rate']?>" />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<? if ( $saved ) { ?>
								<div class="success"><?=t('Данные сохранены')?></div>
							<? } ?>
							<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
						</td>
					</tr>
				</table>
			</form>
		<? } ?>
	<? } ?>
</div>
