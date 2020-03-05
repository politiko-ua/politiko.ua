<div class="popup_header">
	<?=party_helper::photo($party['id'], 's', false, array('class' => 'border1 vcenter'))?>
	<span class="ml10"><?=htmlspecialchars($party['title'])?></span>
</div>

<div class="m10">
	<div class="fs11 mb10" style="width: 350px;">
		<?=t('Вы уверены, что хотите вступить в эту партию? Ваш опыт будет повышен на')?> 5.
		<? if ( $party_id = parties_members_peer::instance()->get(session::get_user_id()) ) { ?>
			<? $current_party = parties_peer::instance()->get_item($party_id) ?>
			<br /><b style="color: red;"><?=t('Внимание, Вам придется покинуть партию')?> &laquo;<?=htmlspecialchars($current_party['title'])?>&raquo; <?=t(' и Ваш опыт будет уменьшен на 10')?></b>
		<? } ?>
	</div>
	<input type="button" class="button" onclick="partiesController.join(<?=$party['id']?>, true);" value=" <?=t('Да, вступить')?> ">
	<input type="button" class="button_gray" onclick="Popup.close();" value=" <?=t('Нет')?> ">
</div>