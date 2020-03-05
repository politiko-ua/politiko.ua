<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Пользователи')?></h1>

	<div class="box_content acenter p10 fs12">
		<form>
			<label class="fs10 quiet"><?=t('Email либо ID пользователя');?></label>
			<input type="text" class="text" name="key" value="<?=$user_key?>" />
			<input type="submit" class="button" value="<?=t('Искать')?>" />
		</form>

		<br /><br />
		<a href="/admin/users_list"><?=t('Список пользователей')?></a> |
		<a href="/admin/users_create"><?=t('Создать пользователя')?></a> |
		<a href="/admin/users_code"><?=t('Сгенерировать код')?></a>
	</div>
	<? if ( $user_key ) { ?>
		<? if ( !$user ) { ?>
			<div class="acenter screen_message acenter"><?=t('Пользователь не найден')?></div>
		<? } else { ?>
			<form method="post">
				<table class="fs12 mt10">
					<tr>
						<td width="30%"><?=t('Имя')?></td>
						<td>
							<?=user_helper::full_name($user['id'])?><br />
							<?=user_helper::photo($user['id'], 't', array('class' => 'mt5'))?>
						</td>
					</tr>
					<tr>
						<td>IP</td>
						<td>
							<?=$user['ip']?><br />
							<? foreach ( $ips as $ip ) { ?>
								<span style="font-size: 11px;"><?=$ip?></span><br />
							<? } ?>
						</td>
					</tr>
					<tr>
						<td>Синонимы имени</td>
						<td>
							<textarea style="width: 250px;" class="text" name="synonyms"><?=htmlspecialchars($dictionary_names['names'])?></textarea><br />
							<input type="checkbox" name="enable_synonyms" value="1" <?=$dictionary_names['names'] ? 'checked' : ''?> /> Включить в словарь персон
						</td>
					</tr>
					<tr>
						<td><?=t('Тип профиля')?></td>
						<td>
							<?=tag_helper::select('type', user_auth_peer::get_types(), array('value' => $user['type']))?>
						</td>
					</tr>
					<tr>
						<td><?=t('Опыт')?></td>
						<td>
							<input type="text" class="text" name="rate" value="<?=$user_data['rate']?>" />
						</td>
					</tr>
					<tr>
						<td><?=t('Статус')?></td>
						<td>
							<input <?=$user['active'] ? 'checked' : ''?> type="radio" name="active" id="active_1" value="1"/> <label for="active_1"><?=t('Активен')?></label>
							<input <?=!$user['active'] ? 'checked' : ''?> type="radio" name="active" id="active_0" value="0"/> <label for="active_0"><?=t('Не активен')?></label>
						</td>
					</tr>
					<tr>
						<td>Выборы</td>
						<td>
							<input <?=candidates_peer::instance()->is_candidate($user['id']) ? 'checked' : ''?> type="checkbox" name="candidate" value="1" id="candidate"/>
							<label for="candidate"><?=t('Кандидат на выборы')?></label>
						</td>
					</tr>
					<? if ( candidates_peer::instance()->is_candidate($user['id']) ) { ?>
						<tr>
							<td></td>
							<td>
								Добавить голосов:
								<input type="text" class="text" name="candidate_votes" value="0" size="8" />
								
							</td>
						</tr>
					<? } ?>
					<tr>
						<td>&nbsp;</td>
						<td>
							<? if ( $saved ) { ?>
								<div class="success"><?=t('Данные сохранены')?></div>
							<? } ?>
							<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
						</td>
					</tr>
				</table>
			</form>
		<? } ?>
	<? } ?>
</div>
