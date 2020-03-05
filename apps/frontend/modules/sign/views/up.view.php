<h1><?=t('Регистрация')?></h1>
<div class="bottom_line_d"></div>

<div class="left" style="width: 45%;">

	<div class="success hidden mr10 mt10">
		<h4><?=t('Поздравляем')?>!</h4>
		<?=t('Ваш аккаунт был создан. Проверьте email, через несколько минут Вам прийдет письмо с инструкциями по активации аккаунта.')?>
	</div>

	<form id="signup_form" class="mt10" method="post">
		<table width="100%" class="fs12">

			<? if ( request::get_int('i') ) { ?>
				<input type="hidden" name="inviter_id" value="<?=request::get_int('i')?>"/>

				<tr>
					<td class="aright"><?=t('Вас пригласил')?></td>
					<td>
						<?=user_helper::photo(request::get_int('i'), 't')?> <br />
						<?=user_helper::full_name(request::get_int('i'))?>
					</td>
				</tr>

			<? } ?>

			<tr>
				<td class="aright"><?=t('Тип аккаунта')?></td>
				<td>
					<? foreach ( user_auth_peer::$register_types as $type_id ) { $types[$type_id] = user_auth_peer::get_type($type_id); } ?>
					<?=tag_helper::select('type', $types)?>
				</td>
			</tr>
			<tr>
				<td width="40%" class="aright"><?=t('Имя')?></td>
				<td width="60%">
					<input value="<?=htmlspecialchars($name[0])?>" type="text" class="text" name="first_name" rel="<?=t('Введите, пожалуйста, Ваше полное имя')?>" />
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Фамилия')?></td>
				<td>
					<input value="<?=htmlspecialchars($name[1])?>" type="text" class="text" name="last_name" rel="<?=t('Введите, пожалуйста, Ваше полное имя')?>" />
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Пол')?></td>
				<td>
					<input type="radio" name="gender" value="m" checked /> <label for="gender_m"><?=t('Мужской')?></label>
					<input type="radio" name="gender" value="f"/> <label for="gender_f"><?=t('Женский')?></label>
				</td>
			</tr>
			<tr>
				<td class="aright">
					<?=t('Политические взгляды')?><Br />
					<a class="quiet fs11" href="/help/political_views"><?=t('Как определиться?')?></a>
				</td>
				<td>
					<? $political_views = political_views_peer::get_list() ?>
					<?=tag_helper::select('political_views', $political_views, array('onchange' => 'signController.switchPoliticalViews();', 'value' => 6))?><br />
					<select name="political_views_sub" id="political_views_sub" style="display: none; margin: 5px 0px 5px 0px;" class="hidden"></select>
					<input class="hidden text" type="text" style="display: none; margin: 5px 0px 5px 0px;" name="political_views_custom" id="political_views_custom">
				</td>
			</tr>
			<!--tr><td colspan="2"></td></tr>
			<tr>
				<td style="color: green;" class="aright">
					<?=t('Код приглашения')?><br />
					<a class="fs11" href="/help/bug"><?=t('Получить код');?></a>
				</td>
				<td><input type="password" class="text" name="code" rel="<?=t('Неверный код приглашения')?>" /></td>
			</tr-->
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

					<input type="submit" name="submit" class="button" value=" <?=t('Создать')?> ">
					<?=tag_helper::wait_panel() ?>

					<br /><br />
				</td>
			</tr>
		</table>
	</form>
</div>

<div class="left" style="width: 55%;">
	<h4 class="mt10 mb10"><?=t('Регистрация позволит Вам')?>:</h4>
	<ul>
		<li><a href="/help/political_views"><?=t('Определиться с Вашими политическими взглядами')?></a></li>
		<li><?=t('Общаться с политиками и экспертами в области политики')?></li>
		<li><?=t('Участвовать в дебатах и опросах')?></li>
		<li><?=t('Высказывать полезные идеи и оценивать идеи других')?></li>
		<li><?=t('Создавать группы и организовывать сообщества')?></li>
		<li><?=t('Ставить оценку партиям и представителям власти')?></li>
		<li><?=t('Вести свой собственный блог и строить политический образ')?></li>
	</ul>
</div>

<div class="clear"></div>
