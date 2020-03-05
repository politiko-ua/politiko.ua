<div class="hidden success aleft" style="width: 400px;">
	<b><?=t('Спасибо!')?></b> <?=t('После подтверждения Вашего голоса, он будет учтен.')?>
	<?=t('Мы выслали письмо на указанный ящик, перейдите по ссылке в нем для подтверждения голоса.')?>
	<input type="button" name="button" onclick="Popup.close();" class="button_gray right" value=" <?=t('Закрыть')?> ">
</div>

<form id="signup_form" action="/signup" class="mt10" method="post" style="width: 400px;">
	<input type="hidden" name="id" value="<?=$candidate_id?>">

	<table width="100%" class="fs12 aleft">

		<tr>
			<td class="aright" width="35%">
				<?=user_helper::photo($candidate_id, 's')?>
			</td>
			<td>
				<div class="mb10 fs11 quiet">
					<?=t('Заполните, пожалуйста, дополнительные данные для голосования')?>.
					<?=t('Голос будет защитан после подтверждения по email')?>.
				</div>
			</td>
		</tr>

		<tr>
			<td class="aright"><?=t('Пол')?></td>
			<td>
				<input type="radio" name="gender" id="gender_m" value="m" checked /> <label for="gender_m"><?=t('Мужской')?></label>
				<input type="radio" name="gender" id="gender_f" value="f"/> <label for="gender_f"><?=t('Женский')?></label>
			</td>
		</tr>
		<tr>
			<td class="aright">
				<?=t('Политические взгляды')?><Br />
			</td>
			<td>
				<? $political_views = political_views_peer::get_list() ?>
				<?=tag_helper::select('political_views', $political_views, array('value' => 6))?><br />
			</td>
		</tr>
		<tr><td colspan="2"></td></tr>
		<tr>
			<td class="aright">Email</td>
			<td>
				<input value="<?=htmlspecialchars($email)?>" type="text" class="text" name="email" rel="required:<?=t('Введите, пожалуйста')?>, email;email:<?=t('Вы ввели неправильный')?> email;" />
			</td>
		</tr>
		<tr>
			<td class="aright"><?=t('Пароль')?></td>
			<td><input type="password" class="text" name="password" rel="<?=t('Введите пароль')?>" /></td>
		</tr>
		<tr>
			<td class="aright"><?=t('Повторите Пароль')?></td>
			<td><input type="password" class="text" name="password_confirm" rel="<?=t('Введенные пароли не совпадают')?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<div class="mt10 mb10 fs11 quiet"><?=t('Все поля обязательны для заполнения')?></div>

				<input type="submit" name="submit" class="button" value=" <?=t('Голосовать')?> ">
				<input type="button" name="button" onclick="Popup.close();" class="button_gray" value=" <?=t('Отмена')?> ">
				<?=tag_helper::wait_panel() ?>

				<br /><br />
			</td>
		</tr>
	</table>
</form>
