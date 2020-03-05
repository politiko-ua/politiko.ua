<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Список пользователей')?></h1>

	<div class="fs10 acenter quiet"><?=t('Последние 500 зарегистрированых пользователей')?></div>

	<div class="box_content p5 fs12 mb10">

		<div class="acenter m10">
			<form action="/admin/users_list">
				<label class="fs10 quiet"><?=t('Поиск по IP');?></label>
				<input type="text" class="text" name="ip" value="<?=request::get('ip')?>" />
				<input type="submit" class="button" value="<?=t('Искать')?>" />
				<? if ( request::get('ip') ) { ?><a class="fs10" href="/admin/users_list"><?=t('Сбросить')?></a><? } ?>
			</form>
		</div>

		<table>
			<tr>
				<th>ID</th>
				<th>Email</th>
				<th>IP</th>
				<th><?=t('Статус')?></th>
			</tr>
			<? foreach ( $list as $id ) { ?>
				<? $user = user_auth_peer::instance()->get_item($id) ?>
				<tr>
					<td><a href="/admin/users?key=<?=$id?>"><?=$id?></a></td>
					<td><a href="/admin/users?key=<?=$id?>"><?=$user['email']?></a></td>
					<td><?=$user['ip']?></td>
					<td><?=$user['active'] ? '<b class="green fs10">активен</b>' : '<em class="maroon fs10">не активен</em>'?></td>
				</tr>
			<? } ?>
		</table>
	</div>

	<div class="bottom_line_d mb10"></div>
	<div class="right pager"><?=pager_helper::get_full($pager)?></div>
</div>
