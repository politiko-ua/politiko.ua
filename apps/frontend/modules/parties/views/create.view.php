<? $sub_menu = '/parties/create'; ?>
<? include 'partials/sub_menu.php' ?>

<? if ( !$allow_create ) { ?>
	<div class="screen_message acenter"><?=t('Вы сможете создать партию, когда Ваш опыт достигнет')?> 300.</div>
<? } else { ?>

<form id="add_form" class="form_bg mt10">
	<h1 class="column_head"><?=t('Основать партию')?></h1>
	<table width="100%" class="fs12">
		<tr>
			<td width="18%" class="aright"><?=t('Название')?></td>
			<td><input rel="<?=t('Введите название партии')?>" name="title" style="width: 500px;" type="text" class="text" /></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="submit" class="button" value=" <?=t('Создать')?> ">
				<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
				<?=tag_helper::wait_panel() ?>
				<div class="success hidden mr10 mt10"><?=t('Партия создана, секунду')?>...</div>
			</td>
		</tr>
	</table>
</form>
<? } ?>