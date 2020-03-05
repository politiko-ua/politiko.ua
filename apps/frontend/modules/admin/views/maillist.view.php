<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Рассылки')?></h1>

	<div class="box_content acenter p10 fs12">
		<? if ( $sent ) { ?>
			Отправлено писем: <b><?=$sent?></b><br />
			<a href="/admin/maillist">Отправить еще</a>
		<? } else { ?>
			<form id="send_form" method="post">
				<input type="hidden" name="send" value="1">
				<input type="hidden" id="mail_mode" name="mail_mode" value="unknown">
				<div class="fs11">
					<a href="javascript:;" onclick="adminController.chageMailMode('unknown');" id="mode_unknown" class="mail_mode bold dotted">Внешняя</a> &nbsp;
					<a href="javascript:;" onclick="adminController.chageMailMode('known');" id="mode_known" class="mail_mode dotted">Пользовательская</a>
				</div>
				<table class="fs11 mode_pane" id="pane_unknown">
					<tr>
						<th>Имя</th>
						<th>Email</th>
					</tr>
					<tr class="maillist_item">
						<td><input type="text" class="text" name="name[]" /></td>
						<td>
							<input type="text" class="text" name="email[]" />
							<input type="button" class="button" value="+" onclick="adminController.maillistAdd(this);" />
							<input type="button" class="button_gray" value="&nbsp;-&nbsp;" onclick="adminController.maillistRemove(this);" />
						</td>
					</tr>
				</table>

				<div class="aleft hidden mode_pane" id="pane_known">
					<div class="left" style="width: 150px;">
						<input onclick="adminController.showMailFilter(this.value);" checked type="radio" name="filter" value="common" /> Всем<br />
						<input onclick="adminController.showMailFilter(this.value);" type="radio" name="filter" value="party" /> Партии<br />
						<input onclick="adminController.showMailFilter(this.value);" type="radio" name="filter" value="group" /> Группы<br />
						<input onclick="adminController.showMailFilter(this.value);" type="radio" name="filter" value="political_views" /> Политические взгляды<br />
						<input onclick="adminController.showMailFilter(this.value);" type="radio" name="filter" value="age" /> Возраст<br />
						<input onclick="adminController.showMailFilter(this.value);" type="radio" name="filter" value="city" /> Город<br />
					</div>
					<div style="margin-left: 160px; margin-top: 10px;">
						<div class="mfilter" id="common_filter"></div>
						<div class="mfilter hidden" id="party_filter">
							<? load::model('parties/parties') ?>
							<?=tag_helper::select('parties[]', parties_peer::instance()->get_select_list(), array('style' => 'width: 250px;', 'multiple' => 'multiple', 'size' => 8))?>
						</div>
						<div class="mfilter hidden" id="group_filter">
							<? load::model('groups/groups') ?>
							<?=tag_helper::select('groups[]', groups_peer::instance()->get_select_list(), array('style' => 'width: 250px;', 'multiple' => 'multiple', 'size' => 8))?>
						</div>
						<div class="mfilter hidden" id="political_views_filter">
							<? load::model('political_views') ?>
							<?=tag_helper::select('political_views', political_views_peer::get_list())?>
						</div>
						<div class="mfilter hidden" id="age_filter">
							От <input class="text" type="text" value="16" size="4" name="age_from" /> &nbsp;
							До <input class="text" type="text" value="85" size="4" name="age_to" />
						</div>
						<div class="mfilter hidden" id="city_filter">
							<?=tag_helper::select('city', array(4 => 'Киев'))?>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="fs11">Тема</div>
				<input rel="Введите тему" type="text" name="subject" class="text" style="width: 100%;" />

				<br />
				<div class="fs11">Сообщение</div>
				<textarea rel="Введите сообщение" name="body" style="width: 100%;"></textarea>
				<div class="fs10">* <b>NAME</b> - для указания имени в письме</div>

				<br />

				<input type="submit" class="button" value="<?=t('Отправить')?>" />
			</form>
		<? } ?>
	</div>
</div>
