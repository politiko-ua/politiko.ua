<h2><?=t('Восстановление пароля')?></h2>
<div class="line_light"></div>

<br /><br />

<div class="success hidden"><?=t('Ваш пароль изменен, теперь Вы можете')?> <a href="/"><?=t('войти в систему')?></a></div>

<br />

<div align="center">
	<form id="change_password_form" method="post">
		<input type="hidden" name="c" value="<?=request::get('c')?>" />

		<label for="password"><?=t('Введите новый пароль')?></label>
		<input type="password" style="width: 150px;" class="text" name="password" rel="<?=t('Введите пароль')?>" />
		<label for="password_confirm"><?=t('Повторите пароль')?></label>
		<input type="password" style="width: 150px;" class="text" name="password_confirm" rel="<?=t('Пароли не совпадают')?>" />
		<input type="submit" name="submit" value=" <?=t('Изменить пароль')?> " />
	</form>
</div>

<br /><br />

<br /><br />