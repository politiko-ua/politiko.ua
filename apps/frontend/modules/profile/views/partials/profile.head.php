<h1 class="mb5 fs18">
	<?=htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name'])?>
	<? if ( session::has_credential('admin') || ( session::get_user_id() == $user['id'] ) ) { ?>
		<a href="/profile/edit<?= session::has_credential('admin') ? '?id=' . $user_data['user_id'] : ''?>" class="ml10 fs11"><?=t('Редактировать')?></a>
	<? } ?>
	<? if ( session::has_credential('admin') ) { ?>
		<a href="/admin/users?key=<?= $user_data['user_id'] ?>" class="ml10 fs11"><?=t('Администрирование')?></a>
	<? } ?>
</h1>
<span style="font-size: 12px;"><?=user_auth_peer::get_type($user['type'])?></span>

<? if ( $user_contacts = unserialize($user_data['contacts']) ) { ?>
	<div class="mt10">
		<? foreach ( $user_contacts as $type => $contact ) if ( $contact ) { ?>
			<a rel="nofollow" href="<?=htmlspecialchars($contact)?>" target="_blank"><?=tag_helper::image('/logos/' . $type . '.png', array('class' => 'vcenter mr5', 'title' => user_data_peer::get_contact_type($type)))?></a>
		<? } ?>
	</div>
<? } ?>

<table class="fs12 mt10">
	<? if ( $user_data['political_views'] && $user_data['show_political_views'] ) { ?>
	<tr>
		<td class="bold aright" width="35%;"><?=t('Политические взгляды')?></td>
		<td>
			<?=political_views_peer::get_name($user_data['political_views'])?>
			<? if ( ( $user_data['political_views'] == 5 ) && $user_data['political_views_custom'] ) { ?>
				(<?=htmlspecialchars($user_data['political_views_custom'])?>)
			<? } ?>
		</td>
	</tr>
	<? } ?>
	<? if ( $user_data['city_id'] ) { ?>
		<? load::model('geo') ?>
		<? $city = geo_peer::instance()->get_city($user_data['city_id']) ?>
		<tr><td class="bold aright" width="35%;"><?=t('Город')?></td><td><?=$city['name_' . translate::get_lang()]?></td></tr>
	<? } ?>
	<? if ( $user_data['interests'] ) { ?>
		<tr><td class="bold aright" width="35%;"><?=t('Интересы')?></td><td><?=htmlspecialchars($user_data['interests'])?></td></tr>
	<? } ?>
	<? if ( $user_data['segment'] ) { ?>
		<tr><td class="bold aright" width="35%;"><?=t('Сфера деятельности')?></td><td><?=htmlspecialchars($user_data['segment'])?></td></tr>
	<? } ?>
	<? if ( $user_data['position'] ) { ?>
		<tr><td class="bold aright" width="35%;"><?=t('Должность')?></td><td><?=htmlspecialchars($user_data['position'])?></td></tr>
	<? } ?>
</table>

<? if ( session::has_credential('admin') ) { ?>
	<div class="fs11 box p10"><form action="/admin/save_user">
		<input type="hidden" name="user_id" value="<?=$user['id']?>">
		<? $credentials = (array)explode(',', $user['credentials']) ?>
		Назначить права:
		<input type="checkbox" <?=in_array('editor', $credentials) ? 'checked' : ''?> name="credentials[]" value="editor" /> Публикатор
		<input type="checkbox" <?=in_array('admin', $credentials) ? 'checked' : ''?> name="credentials[]" value="admin" /> Администратор
		<input type="checkbox" <?=in_array('moderator', $credentials) ? 'checked' : ''?> name="credentials[]" value="moderator" /> Модератор
		<input type="checkbox" <?=in_array('selfmoderator', $credentials) ? 'checked' : ''?> name="credentials[]" value="selfmoderator" /> Самомодератор
		<br /><br />

		<input type="submit" class="button" value=" Сохранить " />

	</form></div>
<? } ?>

<? if ( $user['type'] == user_auth_peer::TYPE_POLITIC ) { ?>
	<div class="pane_head"><?=t('Динамика поддержки')?></div>
	<div id="rate_history" style="z-index: 0" class="acenter m10 fs11 quiet"><?=t('Секунду, график грузится')?>...</div>
	<br />
<? } ?>
