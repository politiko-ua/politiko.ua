<? $sub_menu = '/groups/create'; ?>
<? include 'partials/sub_menu.php' ?>

<? if ( !$allow_create_group ) { ?>
	<div class="screen_message acenter"><?=t('Вы сможете создать группу, когда Ваш опыт достигнет')?> 5.</div>
<? } else { ?>

<form id="add_form" class="form_bg mt10">
	<h1 class="column_head"><?=t('Новая группа')?></h1>
	<table width="100%" class="fs12">
		<tr>
			<td width="18%" class="aright"><?=t('Название')?></td>
			<td><input rel="<?=t('Введите название группы')?>" style="width: 500px;" name="title" type="text" class="text" /></td>
		</tr>
		<tr>
			<td width="18%" class="aright"><?=t('Категория')?></td>
			<td><?=tag_helper::select('type', groups_peer::get_types())?></td>
		</tr>
		<tr>
			<td width="18%" class="aright"><?=t('Территория')?></td>
			<td><?=tag_helper::select('teritory', groups_peer::get_teritories())?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
				<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
				<?=tag_helper::wait_panel() ?>
				<div class="success hidden mr10 mt10"><?=t('Группа создана, ожидайте...')?></div>
			</td>
		</tr>
	</table>
</form>
<? } ?>
