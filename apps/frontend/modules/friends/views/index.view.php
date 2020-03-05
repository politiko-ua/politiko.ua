<? if ( $pending_friends ) { ?>
	<h1 class="column_head mt10 mr10"><?=t('Мои друзья')?> &rarr; <?=t('Запросы на дружбу')?></h1>
	<? foreach ( $pending_friends as $id ) include 'partials/friend_pending.php'; ?>
<? } else { ?>
	<div class="column_head mt10 mr10">
		<h1 class="left"><?=t('Мои друзья')?></h1>
		<a href="/friends/invite" class="right fs11 bold mt5"><?=t('Пригласить друга')?></a>
		<div class="clear"></div>
	</div>
	<? foreach ( $friends as $id ) include 'partials/friend.php'; ?>
<? } ?>