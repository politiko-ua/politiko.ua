<div class="form_bg mt10">
	<h1 class="column_head"><a href="/profile-<?=$user['id']?>"><?=t('Профиль')?></a> &rarr; <?=t('Редактирование')?></h1>

	<div class="tab_pane_gray mb10">
		<a href="javascript:;" id="tab_common" class="tab_menu selected" rel="common"><?=t('Основные сведения')?></a>
		<? if ( $is_candidate ) { ?>
			<a href="javascript:;" id="tab_program" class="tab_menu" rel="program"><?=t('Программа')?></a>
		<? } ?>
		<a href="javascript:;" id="tab_photo" class="tab_menu" rel="photo"><?=t('Фото')?></a>
		<a href="javascript:;" id="tab_settings" class="tab_menu" rel="settings"><?=t('Настройки')?></a>
		<a href="javascript:;" id="tab_blacklist" class="tab_menu" rel="blacklist"><?=t('Черный список')?></a>
		<div class="clear"></div>
	</div>

	<form id="common_form" class="form mt10">
		<? if ( session::has_credential('admin') ) { ?>
			<input type="hidden" name="id" value="<?=$user_data['user_id']?>">
		<? } ?>
		<input type="hidden" name="type" value="common">
		<table width="100%" class="fs12">
			<tr>
				<td class="aright"><?=t('Имя, Фамилия')?></td>
				<td>
					<input name="first_name" rel="<?=t('Введите полное имя')?>" class="text" type="text" value="<?=htmlspecialchars($user_data['first_name'])?>" />
					<input name="last_name" rel="<?=t('Введите полное имя')?>" class="text" type="text" value="<?=htmlspecialchars($user_data['last_name'])?>" />
				</td>
			</tr>
			<tr>
				<td width="30%" class="aright"><?=t('Политические взгляды')?></td>
				<? $political_views = political_views_peer::get_list(); ?>
				<td>
					<?=tag_helper::select('political_views', $political_views, array('onchange' => 'profileController.switchPoliticalViews();', 'value' => $user_data['political_views']))?>
					<select name="political_views_sub" id="political_views_sub" class="hidden"></select>
					<input class="<?=$user_data['political_views']!=5 ? 'hidden' : ''?> text" type="text" name="political_views_custom" value="<?=htmlspecialchars( $user_data['political_views_custom'])?>" id="political_views_custom">
					<a class="quiet fs11 ml10" href="/help/political_views"><?=t('Как определится?')?></a>
					<div class="mt5 quiet fs11 mb5">
						<input type="checkbox" name="show_political_views" value="1" <?=$user_data['show_political_views'] ? 'checked' : ''?>>
						<label for="show_political_views"><?=t('Показывать политические взгляды на моем профиле')?></label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Возраст')?></td>
				<? $ages = range(15, 107) ?>
				<td><?=tag_helper::select('age', $ages, array('use_values' => true, 'value' => $user_data['age']))?></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Пол')?></td>
				<td>
					<input type="radio" name="gender" value="m" <?=$user_data['gender'] == 'm' ? 'checked' : ''?> />
					<label for="gender_m"><?=t('Мужской')?></label>
					
					<input type="radio" name="gender" value="f" <?=$user_data['gender'] == 'f' ? 'checked' : ''?> />
					<label for="gender_f"><?=t('Женский')?></label>
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Город')?></td>
				<td>
					<input name="city_id" type="hidden" value="<?=$user_data['city_id']?>" />
					<? load::model('geo') ?>
					<? $city = geo_peer::instance()->get_city($user_data['city_id']) ?>
					<input name="city" class="text" type="text" value="<?=$city['name_' . translate::get_lang()]?>" />
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Сфера деятельности')?></td>
				<td><input name="segment" class="text" type="text" value="<?=htmlspecialchars($user_data['segment'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Должность')?></td>
				<td><input name="position" class="text" type="text" value="<?=htmlspecialchars($user_data['position'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Интересы')?></td>
				<td><textarea style="height: 75px; width: 400px;" name="interests"><?=htmlspecialchars($user_data['interests'])?></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Биография')?></td>
				<td><textarea style="height: 75px; width: 400px;" name="bio"><?=htmlspecialchars($user_data['bio'])?></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Контакты')?></td>
				<td>
					<? $user_contacts = unserialize($user_data['contacts']); ?>
					<? foreach ( user_data_peer::get_contact_types() as $type => $type_title ) { ?>
						<div class="mb5">
							<?=tag_helper::image('/logos/' . $type . '.png', array('class' => 'vcenter', 'title' => $type_title))?>
							<input type="text" name="contacts[<?=$type?>]" class="text" value="<?=htmlspecialchars($user_contacts[$type])?>" />
						</div>
					<? } ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel('common_wait') ?>
					<div class="success hidden mr10 mt10"><?=t('Изменения сохранены')?></div>
				</td>
			</tr>

		</table>
	</form>

	<form id="photo_form" action="/profile/edit?type=photo&submit=1<?=session::has_credential('admin') ? '&id=' . $user_data['user_id'] : ''?>" class="hidden form mt10" enctype="multipart/form-data">
		<? if ( session::has_credential('admin') ) { ?>
			<input type="hidden" name="id" value="<?=$user_data['user_id']?>">
		<? } ?>

		<div class="left acenter" style="width: 250px;">
			<?=user_helper::photo($user_data['user_id'], 'p', array('class' => 'border1', 'id' => 'photo'))?>
		</div>
		<table class="left fs12" style="width: 430px;">
			<tr>
				<td colspan="2">
					<Br />
					<?=t('Вы можете загрузить фотографию почти любого типа и размера, она будет автоматически преобразована для отображения в Вашем профиле.')?>
					<br /><br /><br />
				</td>
			</tr>
			<tr>
				<td class="aright" width="30%"><?=t('Выберите файл')?></td>
				<td><input type="file" name="file" rel="<?=t('Картинка неверная либо слишком большая')?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel('photo_wait') ?>
					<div class="success hidden mr10 mt10"><?=t('Изменения сохранены')?></div>
				</td>
			</tr>
		</table>
		<div class="clear"></div><br />
	</form>

	<? if ( $is_candidate ) { ?>
		<form id="program_form" class="hidden form mt10" method="post">
			<? if ( session::has_credential('admin') ) { ?>
				<input type="hidden" name="id" value="<?=$user_data['user_id']?>">
			<? } ?>
			<input type="hidden" name="type" value="program">
			<table width="100%" class="fs12">
				<tr>
					<td width="30%" class="aright"><?=t('Текст программы')?></td>
					<td>
						<textarea name="program" class="text"><?=htmlspecialchars($candidate['program'])?></textarea>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<div class="mt10"></div>
						<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
						<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
						<?=tag_helper::wait_panel('program_wait') ?>
						<div class="success hidden mr10 mt10"><?=t('Изменения сохранены')?></div>
					</td>
				</tr>

			</table>

			<script src="/static/javascript/library/tinymce/tiny_mce.js"></script>
			<script type="text/javascript">
			// O2k7 skin
			tinyMCE.init({
				mode : "exact",
				language : '<?=translate::get_lang() == 'ru' ? 'ru' : 'uk'?>',
				elements : "program",
				theme : "advanced",
				skin : "o2k7",
				plugins : "insertdatetime,contextmenu,paste,directionality,visualchars,xhtmlxtras,table,media,youtube",

				theme_advanced_buttons1 : "bold,italic,underline,blockquote,|,forecolor,|,bullist,numlist,|,link,image,youtube,|,tablecontrols",
				theme_advanced_buttons2 : "",
				theme_advanced_buttons3 : "",
				theme_advanced_buttons4 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",

				content_css: '/static/css/typography.css'
			});
			</script>

		</form>
	<? } ?>

	<form id="settings_form" class="hidden form mt10">
		<? if ( session::has_credential('admin') ) { ?>
			<input type="hidden" name="id" value="<?=$user_data['user_id']?>">
		<? } ?>
		<input type="hidden" name="type" value="settings">
		<table width="100%" class="fs12">
			<tr>
				<td width="30%" class="aright"><?=t('Получать уведомления')?></td>
				<td>
					<input type="radio" name="notify" value="1" <?=$user_data['notify'] ? 'checked' : ''?> />
					<label for="notify_1"><?=t('Да')?></label>

					<input type="radio" name="notify" value="0" <?=!$user_data['notify'] ? 'checked' : ''?> />
					<label for="notify_0"><?=t('Нет')?></label>

					<div class="quiet fs11 mt5 mb10">
						<?=t('Уведомления помогут Вам быть в курсе событий на сайте.')?>
						<?=t('Вы будете получать уведомление на почту, когда кто-либо пишет Вам сообщение, комментирует Ваш блог, отвечает на Ваш опрос и т. д.')?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="aright">Email</td>
				<td>
					<input name="email" rel="<?=t('Введите правильный')?> email" class="text" type="text" value="<?=htmlspecialchars($user['email'])?>" />
					<div class="quiet fs11 mt5 mb10">
						<b><?=t('Внимание')?>!</b>
						<?=t('Ваш email используется для входа в систему. Если Вы измените его, используйте новый email для входа.')?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Новый пароль')?></td>
				<td>
					<input name="new_password" rel="<?=t('Введенные пароли не совпадают')?>" class="text" type="password" value="" />
					<input name="new_password_confirm" class="text" type="password" value="" />
					<div class="quiet fs11 mt5 mb10">
						<?=t('Если Вы хотите изменить пароль, введите новый в обоих полях.')?>
					</div>
				</td>
			</tr>

<? /*
			<tr>
				<td class="aright"><?=t('Удаление профиля')?></td>
				<td>
					<a href="javascript:;" style="color: maroon;" onclick="profileController.deleteProfile();"><?=t('Удалить профиль')?></a>

					<div class="quiet fs11 mt5 mb10">
						<b><?=t('Внимание!')?></b>
						<?=t('Если Вы удалите свой аккаунт, Вы <b>не сможете восстановить</b> его при повторной регистрации')?>!
					</div>
				</td>
			</tr>*/ ?>

			<tr>
				<td></td>
				<td>
					<div class="mt10"></div>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel('settings_wait') ?>
					<div class="success hidden mr10 mt10"><?=t('Изменения сохранены')?></div>
				</td>
			</tr>

		</table>
	</form>

	<div id="blacklist_form" class="hidden form mt10 p10 fs12">
		<?=t('Черный список поможет избежать неконструктивных обсуждений.')?>
		<?=t('Если Вы добавили пользователя в свой черный список, то он не сможет комментировать Ваши посты и ставить им оценки.')?>
		<br/><br/>

		<? if ( !$blacklist ) { ?>
			<div class="screen_message acenter"><?=t('В Вашем списке пока пусто')?></div>
		<? } ?>

		<ul>
		<? foreach ( $blacklist as $id ) { ?>
			<li id="banned_<?=$id?>" class="mb5">
				<?=user_helper::full_name($id)?>
				<a class="ml10 fs10 maroon" href="javascript:;" onclick="profileController.unBan(<?=$id?>);"><?=t('удалить')?></a>
			</li>
		<? } ?>
		</ul>
	</div>

</div>
