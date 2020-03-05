<div class="popup_header">
	<?=party_helper::photo($party['id'], 's', false, array('class' => 'border1 vcenter'))?>
	<span class="ml10"><?=htmlspecialchars($party['title'])?></span>
</div>

<div class="m10">
	<div class="fs11 mb10"><?=t('Вы уверены, что хотите покинуть партию? Ваш опыт будет понижен на')?> 10.</div>
	<input type="button" class="button" onclick="partiesController.leave(<?=$party['id']?>, true);" value=" <?=t('Да, покинуть')?> ">
	<input type="button" class="button_gray" onclick="Popup.close();" value=" <?=t('Нет')?> ">
</div>