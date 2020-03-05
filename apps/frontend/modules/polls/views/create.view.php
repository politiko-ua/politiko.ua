<? $sub_menu = '/polls/create'; ?>
<? include 'partials/sub_menu.php' ?>

<? if ( !$allow_create ) { ?>
	<div class="screen_message acenter"><?=t('Вы сможете создать вопрос, когда Ваш опыт достигнет')?> 35.</div>
<? } else { ?>

<div class="form_bg">
	<h1 class="column_head"><?=t('Новый вопрос')?></h1>
	<form id="add_form" class="form mt10">
		<table width="100%" class="fs12">
			<tr>
				<td width="18%" class="aright"><?=t('Вопрос')?></td>
				<td><textarea style="width: 500px; height: 50px;" name="question" rel="<?=t('Введите вопрос')?>"></textarea></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Варианты')?></td>
				<td>
					<ol id="answers" class="mb5">
						<? for ( $i = 0; $i < 3; $i++ ) { ?>
							<li class="mb5">
								<input type="text" style="width: 435px;" name="answer[]" class="answer text"/>
								<input type="button" value=" + " class="button" onclick="pollsController.addAnswer(this);" />
								<input type="button" value=" - " class="button_gray" onclick="pollsController.removeAnswer(this);" />
							</li>
						<? } ?>
					</ol>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="checkbox" name="is_multi" value="1">
					<label for="is_multi"><?=t('Несколько вариантов ответа')?></label>
					<div class="mb5 quiet fs11"><?=t('Пользователь сможет выбрать несколько вариантов ответов')?></div>
					<input type="checkbox" name="is_custom" value="1">
					<label for="is_custom"><?=t('Свой вариант')?></label>
					<div class="mb5 quiet fs11"><?=t('Пользователь сможет вписать свой вариант ответа')?></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel() ?>
					<div class="success hidden mr10 mt10"><?=t('Опрос создан')?></div>
				</td>
			</tr>

		</table>
	</form>
</div>
<? } ?>