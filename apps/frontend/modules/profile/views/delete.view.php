<div class="popup_header">
	<h3 class="mb5"><?=t('Удаление профиля')?></h3>
</div>

<div class="m10">
	<div class="fs11 mb10">
		<?=t('Вы уверены, что хотите удалить свой профиль?')?>
	</div>
	<input type="button" class="button" onclick="document.location='/profile/delete_process?hash=<?=$hash?>';" value=" <?=t('Да, удалить')?> ">
	<input type="button" class="button_gray" onclick="Popup.close();" value=" <?=t('Нет')?> ">
</div>