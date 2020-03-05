<div class="popup_header" rel="<?=t('Спасибо, Ваше сообщение было отправлено!')?>">
	<h2><?=t('Поделиться с друзьями')?></h2>
</div>

<? if ( $error ) { ?>
	<div class="m10 fs12 acenter maroon">
		<?=$error?><br /><br/>
		<input type="button" class="button_gray" onclick="Popup.close();" value=" <?=t('ОК')?> ">
	</div>
<? } else { ?>
	<form rel="<?=t('Выберите друзей из списка')?>" id="share_form" action="/messages/share?process" method="post" onsubmit="return Application.shareItemProcess();">
		<input type="hidden" name="id" value="<?=$data['id']?>" />
		<input type="hidden" name="type" value="<?=$type?>" />

		<div class="m10 fs11 aleft" style="width: 550px;">
			<div class="mb5 quiet left"><?=t('Выберите друзей')?>: </div>
			<div class="mb5 quiet right">
				<input type="checkbox" id="select_all_friends" onchange="Application.friendsToggle();">
				<label for="select_all_friends"><?=t('Выбрать всех')?></label>
			</div>
			<div class="clear"></div>
			<div class="friend_selector">
				<? foreach ( $friends as $friend_id ) { ?>
					<input type="checkbox" class="friend_check hidden" name="friends[]" id="friend_check_<?=$friend_id?>" value="<?=$friend_id?>">
					<div id="friend_<?=$friend_id?>" rel="<?=$friend_id?>" class="item friend" onclick="Application.friendSelect(<?=$friend_id?>);">
						<?=user_helper::photo($friend_id, 's', array('class' => 'left', 'width' => '40'), false)?>
						<div style="margin-left: 50px;"><a class="dotted"><?=user_helper::full_name($friend_id, false)?></a></div>
					</div>
				<? } ?>
				<div class="clear pb10"></div>
			</div>

			<div class="left">
				<div class="mb5 mt10 quiet"><?=t('Напишите короткое сообщение')?>: </div>
				<textarea name="message" style="height: 50px; width: 200px;"><?=t('Привет, хочу поделиться с тобой полезной информацией')?>:</textarea>

				<div class="mt10">
					<input type="submit" class="button" value=" <?=t('Отправить')?> ">
					<input type="button" class="button_gray" onclick="Popup.close();" value=" <?=t('Отмена')?> ">
				</div>
			</div>
			<div style="margin-left: 225px;">
				<div class="mb5 mt10 quiet"><?=t('Вы поделитесь этим')?>: </div>
				<?=$html?>
			</div>
			<div class="clear pb5"></div>
		</div>
	</form>
<? } ?>