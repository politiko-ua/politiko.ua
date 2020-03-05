<div class="form_bg">
	<h1 class="column_head mt10"><a href="/messages"><?=t('Cообщения')?></a> &rarr; <?=t('Новое сообщение')?></h1>

	<form id="compose_form" class="form mt10" rel="<?=t('Начинайте вводить имя друга')?>..." onsubmit="return false;">
		<input type="hidden" name="receiver_id" value="<?=$user['user_id']?>" />
		<table width="100%" class="fs12">
			<tr>
				<td class="aright"><?=t('Имя получателя')?></td>
				<td>
					<input type="text" class="text" rel="<?=t('Выберите получателя')?>" style="width: 500px;" name="receiver" />
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Сообщение')?></td>
				<td><textarea rel="<?=t('Введите текст сообщения')?>" name="body" style="width: 500px; height:150px;"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Отправить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel() ?>
					<div class="success hidden mr10 mt10"><?=t('Сообщение отправлено')?></div>
				</td>
			</tr>

		</table>
	</form>
</div>
