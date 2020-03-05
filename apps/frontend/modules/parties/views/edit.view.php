<div class="mt10 mr10 form_bg">
	<h1 class="column_head"><a href="/party<?=$party['id']?>"><?=t('Партия')?></a> &rarr; <?=t('Редактирование')?></h1>

	<div class="tab_pane_gray mb10">
		<a href="javascript:;" class="tab_menu selected" rel="common"><?=t('Основные сведения')?></a>
		<a href="javascript:;" class="tab_menu" rel="photo"><?=t('Фото')?></a>
		<a href="javascript:;" class="tab_menu" rel="news"><?=t('Новости')?></a>
		<a href="javascript:;" class="tab_menu" rel="program"><?=t('Программа')?></a>
		<a href="javascript:;" class="tab_menu" rel="leaders"><?=t('Лидеры')?></a>
		<? if ( $party['user_id'] == session::get_user_id() ) { ?>
			<a href="javascript:;" class="tab_menu" rel="moderators"><?=t('Модераторы')?></a>
		<? } ?>
		<div class="clear"></div>
	</div>

	<form id="common_form" class="form mt10">
		<input type="hidden" name="type" value="common">
		<input type="hidden" name="id" value="<?=$party['id']?>">
		<table width="100%" class="fs12">
			<tr>
				<td class="aright"><?=t('Название партии')?></td>
				<td><input name="title" style="width: 500px;" class="text" type="text" value="<?=htmlspecialchars($party['title'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Направление')?></td>
				<td>
					<?=tag_helper::select('direction', political_views_peer::get_list(), array('value' => $party['direction'], 'onchange' => 'partiesController.switchDirection();'))?>
					<input class="<?=$party['direction']!=5 ? 'hidden' : ''?> text" type="text" name="direction_custom" value="<?=htmlspecialchars( $party['direction_custom'])?>" id="direction_custom">
				</td>
			</tr>
			<tr>
				<td class="aright">Web <?=t('сайт')?></td>
				<td><input name="url" style="width: 500px;" class="text" type="text" value="<?=htmlspecialchars($party['url'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Цели')?></td>
				<td><textarea name="aims" style="width: 500px;"><?=htmlspecialchars($party['aims'])?></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Описание')?></td>
				<td><textarea name="description" style="width: 500px;"><?=htmlspecialchars($party['description'])?></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Контакты')?></td>
				<td>
					<? $contacts = unserialize($party['contacts']); ?>
					<? foreach ( parties_peer::get_contact_types() as $type => $type_title ) { ?>
						<div class="mb5">
							<?=tag_helper::image('/logos/' . $type . '.png', array('class' => 'vcenter', 'title' => $type_title))?>
							<input type="text" name="contacts[<?=$type?>]" class="text" value="<?=htmlspecialchars($contacts[$type])?>" />
							<?=$type_title?>
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

	<form id="photo_form" action="/parties/edit?type=photo&submit=1&id=<?=$party['id']?>" class="hidden form mt10" enctype="multipart/form-data">
		<div class="left acenter" style="width: 250px;">
			<?=party_helper::photo($party['id'], 'p', false, array('class' => 'border1', 'id' => 'photo'))?>
		</div>

		<table class="left fs12" style="width: 400px;">
			<tr>
				<td colspan="2">
					<br />
					<?=t('Вы можете загрузить фотографию почти любого типа и размера, она будет автоматически преобразована для отображения в профиле партии.')?>
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
		<div class="clear"></div><br />
	</form>

	<form id="news_form" class="hidden form mt10 m10">
		<input type="hidden" name="type" value="news">
		<input type="hidden" name="id" value="<?=$party['id']?>">

		<div class="m10 fs11 quiet"><?=t('Для редактирования новостей перейдите')?> <a href="/parties/news?id=<?=$party['id']?>"><?=t('на эту страницу')?></a></div>

		<table width="100%" class="fs12" id="add_news">
			<tr>
				<td class="aright"><?=t('Текст новости')?></td>
				<td><textarea rel="<?=t('Введите текст новости')?>" name="text" style="width: 500px; height: 200px;"><?=htmlspecialchars($program[$id])?></textarea></td>
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

	<form id="program_form" class="hidden form mt10">
		<input type="hidden" name="type" value="program">
		<input type="hidden" name="id" value="<?=$party['id']?>">
		<table width="100%" class="fs12">
			<? foreach ( ideas_peer::get_segments() as $id => $title ) { ?>
			<tr>
				<td class="aright"><label for="program_<?=$id?>"><?=$title?></label></td>
				<td><textarea id="program_<?=$id?>" name="program[<?=$id?>]" onblur="$(this).css('height', '50px');" onfocus="$(this).css('height', '200px');" style="width: 350px; height: 50px;"><?=htmlspecialchars($program[$id]['text'])?></textarea></td>
			</tr>
			<? } ?>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel('program_wait') ?>
					<div class="success hidden mr10 mt10"><?=t('Изменения сохранены')?></div>
				</td>
			</tr>

		</table>
	</form>
	<? if ( $party['user_id'] == session::get_user_id() ) { ?>
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
				<input type="button" class="button" onclick="partiesController.addModerator();" value=" <?=t('Добавить')?> " />
			</div>

		</div>
	<? } ?>
	<div id="leaders_form" class="hidden form p10">

		<div class="fs12">
			<div class="bold mb5"><?=t('Список лидеров')?></div>
			<? if ( !$leaders ) { ?>
				<div id="no_leaders" class="quiet fs11 mb10"><?=t('Список пуст')?></div>
			<? } ?>
			<div id="leaders">
				<? foreach ( $leaders as $leader_id ) { include 'partials/leader.php'; } ?>
			</div>
		</div>


		<div class="fs12">
			<div class="mb5">
				<b><?=t('Добавить лидера')?></b>
				<span class="quiet fs11">(<?=t('Укажите ссылку на анкету человека, либо введите его')?> ID)</span><br />
			</div>
			<input type="text" id="new_leader" class="text">
			<input type="button" class="button" onclick="partiesController.addLeader();" value=" <?=t('Добавить')?> " />
		</div>

	</div>
</div>
