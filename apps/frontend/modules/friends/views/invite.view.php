<style>
form.invite {
    background: none repeat scroll 0 0 #EEEEEE;
    margin: 0 0 10px;
    padding: 10px;
}
form.invite fieldset .form {
    float: left;
    width: 290px;
}
form.invite fieldset .form input {
    width: 140px;
}
form.invite fieldset p {
    color: #555555;
    float: left;
    width: 305px;
    margin-left: 15px;
    font-size: 13px;
}
</style>
<h1 class="column_head mt10 mr10"><a href="/friends"><?=t('Мои друзья')?></a> &rarr; <?=t('Приглашение')?></h1>
<? if ( $invited ) { ?>
        <div class="success mt15"><?=t('Приглашения были успешно отправлены')?>. <a href="/profile/friends"><?=t('Вернуться к друзьям')?></a></div>

<? } elseif ( !$contacts ) { ?>
	<? if ( $error ) { ?>
		<p class="error"><?=t('Не удалось получить контакты. Пожалуйста, проверьте свою электронную почту/пароль, или попробуйте чуть позже') ?></p>
	<? } ?>

<form method="post" action="/friends/invite" class="invite">
	<h4><?=t('С помощью этой формы Вы можете отправить приглашение на Politiko своим знакомым и друзьям')?>!</h4>
	<fieldset>
		<div class="form">
			<div class="left ml5 bold" style="width:120px"><?=t('Сервис')?></div>
                        <div class="left ml5 mb5">
                            <select name="service">
                                    <? foreach ( $invite_services as $type => $providers ) { ?>
                                            <optgroup label="<?=$inviter->pluginTypes[$type]?>">
                                                    <? foreach ($providers as $provider => $details) { ?>
                                                            <option <?=request::get('service') == $provider ? 'selected' : ''?> value="<?=$provider?>"><?=$details['name']?></option>
                                                    <? } ?>
                                            </optgroup>
                                    <? } ?>
                            </select>
                        </div>
			<div class="left ml5 bold" style="width:120px">Email/<?=t('Логин')?></div>
                        <div class="left ml5 mb5">
                            <input type="text" name="email" class="text"/>
                        </div>
			<div class="left ml5 bold" style="width:120px"><?=t('Пароль')?></div>
                        <div class="left ml5 mb5">
			<input type="password" name="password" class="text"/>
                        </div>
                        <div class="aright mr15">
			<button class="button" type="submit"><?=t('Пригласить')?></button>
                        </div>
		</div>

		<p>
			<?=t('Вы можете импортировать/пригласить свои контакты из популярных сервисов, таких как Facebook, Gmail, Yahoo, Twitter, LinkedIn и многие другие.
Мы <b> не </b> храним пароли или контактную информацию, так что это полностью безопасно.')?>
		</p>

		<div class="clear"></div>
	</fieldset>
</form>
<? } else { ?>
	<form  method="post" id="form_send_invites"  class="form mt10">
		<? if ( $users ) { ?>
			<h4><?=t('Добавить Ваши контакты')?></h4>
			<ul class="invite-users">
				<? foreach ( $users as $user ) { ?>
					<li>
						<?=  user_helper::photo($user, 't')?>
						<p>
							<?=user_helper::full_name($user)?><br/>
							<input type="checkbox" name="friend[<?=$user['id']?>]"/>
							<span><?=t('Пригласить')?></span>
						</p>
					</li>
				<? } ?>
			</ul>
			<div class="clear"></div><br />
		<? } ?>

		<h4>
			<?=t('Выберите больше людей, которых вы хотите пригласить')?>
			(<a href="javascript:;" onclick="$('#contacts input').attr('checked', 'checked')"><?=t('все')?></a> /
			<a href="javascript:;" onclick="$('#contacts input').attr('checked', null)"><?=t('ничего')?></a>)
		</h4>

		<ul id="contacts" class="contacts-invite">
			<? foreach ( $contacts as $email => $name ) { ?>
				<li>
					<input type="checkbox" name="invite[<?=$email?>]" />
					<?= htmlspecialchars($name)?>
			<? } ?>
		</ul>

		<input type="submit" name="submit" class="submit"  value="<?=t('Отправить приглашения')?>" />
                <?=tag_helper::wait_panel() ?>
	</form>

	<div class="success hidden"><?=t('Приглашения были успешно отправлены')?>. <a href="/profile/friends"><?=t('Вернуться к друзьям')?></a></div>


	<div class="clear"></div><br />
<? } ?>
<?/*
<form id="invite_form" class="form" method="post">
	<table width="100%" class="fs12">
		<tr>
			<td class="aright" width="28%"><?=t('Имя')?></td>
			<td><input name="name" rel="<?=t('Введите имя')?>" style="width:300px;" class="text" type="text"/></td>
		</tr>
		<tr>
			<td class="aright"><?=t('Email')?></td>
			<td><input name="email" rel="<?=t('Введите email')?>" style="width:300px;" class="text" type="text"/></td>
		</tr>
		<tr>
			<td class="aright"><?=t('Сообщение')?></td>
			<td><textarea name="message" onfocus="$(this).css('height', '150px')" style="height:50px;width:300px;"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="submit" class="button" value=" <?=t('Пригласить')?> ">
				<?=tag_helper::wait_panel() ?>

				<div class="success hidden mr10 mt10"><?=t('Приглашение отправлено')?></div>
			</td>
		</tr>

	</table>

</form>
*/?>