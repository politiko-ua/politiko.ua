<div class="mt10 mr10 form_bg">
	<h1 class="column_head"><a href="/group<?=$group['id']?>"><?=t('Группа')?></a> &rarr; Редактирование</h1>

	<div class="tab_pane_gray mb10">
		<a href="javascript:;" class="tab_menu selected" rel="common"><?=t('Основные сведения')?></a>
		<a href="javascript:;" class="tab_menu" rel="photo"><?=t('Фото')?></a>
		<a href="javascript:;" class="tab_menu" rel="news"><?=t('Новости')?></a>
		<? if ( ( $group['user_id'] == session::get_user_id() ) || session::has_credential('admin') ) { ?>
			<a href="javascript:;" class="tab_menu" rel="moderators"><?=t('Модераторы')?></a>
			<? if ( $group['privacy'] == groups_peer::PRIVACY_PRIVATE ) { ?>
				<a href="javascript:;" class="tab_menu" rel="applicants">
					<?=t('Заявки')?>
					<span id="new_applicants" class="green fs10"><?=$applicants ? '+' . count($applicants) : ''?></span>
				</a>
			<? } ?>
		<? } ?>
		<div class="clear"></div>
	</div>

	<form id="common_form" class="form mt10">
		<input type="hidden" name="type" value="common">
		<input type="hidden" name="id" value="<?=$group['id']?>">
		<table width="100%" class="fs12">
			<tr>
				<td class="aright"><?=t('Название группы')?></td>
				<td><input name="title" style="width: 350px;" class="text" type="text" value="<?=htmlspecialchars($group['title'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Категория')?></td>
				<td><?=tag_helper::select('gtype', groups_peer::get_types(), array('value' => $group['type']))?></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Территория')?></td>
				<td><?=tag_helper::select('teritory', groups_peer::get_teritories(), array('value' => $group['teritory']))?></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Приватность')?></td>
				<td>
					<input <?=$group['privacy'] == groups_peer::PRIVACY_PUBLIC ? 'checked' : ''?> type="radio" id="privacy_<?=groups_peer::PRIVACY_PUBLIC?>" name="privacy" value="<?=groups_peer::PRIVACY_PUBLIC?>"/>
					<label for="privacy_<?=groups_peer::PRIVACY_PUBLIC?>"><?=t('Публичная')?></label>

					<input <?=$group['privacy'] == groups_peer::PRIVACY_PRIVATE ? 'checked' : ''?> type="radio" id="privacy_<?=groups_peer::PRIVACY_PRIVATE?>" name="privacy" value="<?=groups_peer::PRIVACY_PRIVATE?>"/>
					<label for="privacy_<?=groups_peer::PRIVACY_PRIVATE?>"><?=t('Приватная')?></label>
					<div class="mt5 quiet fs11"><?=t('Приватные группы будут доступны только вступившим в них учасникам.')?></div>
				</td>
			</tr>
			<tr>
				<td class="aright"><?=t('Web сайт')?></td>
				<td><input name="url" style="width: 350px;" class="text" type="text" value="<?=htmlspecialchars($group['url'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Цели')?></td>
				<td><textarea name="aims" style="width: 350px;"><?=htmlspecialchars($group['aims'])?></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Описание')?></td>
				<td><textarea name="description" style="width: 350px;"><?=htmlspecialchars($group['description'])?></textarea></td>
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

	<form id="photo_form" action="/groups/edit?type=photo&submit=1&id=<?=$group['id']?>" class="hidden form mt10" enctype="multipart/form-data">
		<div class="left acenter" style="width: 250px;">
			<?=group_helper::photo($group['id'], 'p', false, array('class' => 'border1', 'id' => 'photo'))?>
		</div>
		<table class="left fs12" style="width: 400px;">
			<tr>
				<td colspan="2">
					<?=t('Вы можете загрузить фотографию почти любого типа и размера, она будет автоматически преобразована для отображения в профиле группы.')?>
					<br /><br /><br />
				</td>
			</tr>
			<tr>
				<td class="aright" width="150"><?=t('Выберите файл')?></td>
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
		<div class="clear"></div>
	</form>

	<form id="news_form" class="hidden form mt10 m10">
		<input type="hidden" name="type" value="news">
		<input type="hidden" name="id" value="<?=$group['id']?>">

		<div class="m10 fs11 quiet"><?=t('Для редактирования новостей перейдите')?> <a href="/groups/news?id=<?=$group['id']?>"><?=t('на эту страницу')?></a></div>

		<table width="100%" class="fs12" id="add_news">
			<tr>
				<td class="aright"><?=t('Текст новости')?></td>
				<td><textarea rel="<?=t('Введите текст новости')?>" name="text" style="width: 500px; height: 200px;"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Добавить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel('news_wait') ?>
					<div class="success hidden mr10 mt10"><?=t('Новость добавлена')?></div>
				</td>
			</tr>
		</table>
	</form>

	<? if ( ( $group['user_id'] == session::get_user_id() ) || session::has_credential('admin') ) { ?>
		<div id="moderators_form" class="hidden form p10">

			<div class="fs12">
				<div class="bold mb5"><?=t('Список модераторов')?></div>
				<? if ( !$moderators ) { ?>
					<div id="no_moderators" class="quiet fs11 mb10"><?=t('Список пуст')?></div>
				<? } ?>
				<div id="moderators">
					<? foreach ( $moderators as $moderator_id ) { include 'partials/moderator.php'; } ?>
				</div>
			</div>


			<div class="fs12">
				<div class="mb5">
					<b><?=t('Добавить модератора')?></b>
					<span class="quiet fs11">(<?=t('Укажите ссылку на анкету человека, либо введите его')?> ID)</span><br />
				</div>
				<input type="text" id="new_moderator" class="text">
				<input type="button" class="button" onclick="groupsController.addModerator();" value=" <?=t('Добавить')?> " />
			</div>

		</div>

		<div id="applicants_form" class="hidden form p10">
			<div class="fs12">
				<div class="bold mb5"><?=t('Список заявок на вступление')?></div>
				<? if ( !$applicants ) { ?>
					<div id="no_applicants" class="quiet fs11 mb10"><?=t('Список пуст')?></div>
				<? } else { ?>
				<div id="applicants">
					<? foreach ( $applicants as $applicant_id ) { include 'partials/applicant.php'; } ?>
				</div>
				<? } ?>
			</div>
			<br />
		</div>
	<? } ?>

</div>
