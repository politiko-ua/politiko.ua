<h2><?=t('Восстановление пароля')?></h2>
<div class="line_light"></div>

<br /><br />

<div class="success hidden"><?=t('Уникальная ссылка для изменения пароля отправлена Вам на почту')?></div>

<br />

<div align="center">
	<form id="recover_form" method="post">
		<label for="email"><?=t('Введите')?> Email</label>
		<input type="text" class="text" name="email" rel="required:<?=t('Введите, пожалуйста')?>, email;email:<?=t('Вы ввели неправильный')?> email;" />
		<input type="submit" name="submit" value=" <?=t('Восстановить пароль')?> " />
	</form>
</div>

<br /><br />

<br /><br />
