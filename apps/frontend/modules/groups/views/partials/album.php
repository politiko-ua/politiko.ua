<div class="left acenter fs12" style="width: 170px; height: 200px;">
	<? $screen_id = groups_photos_albums_peer::instance()->get_album_screen_photo($album_id, $group['id']) ?>
	<? $album = groups_photos_albums_peer::instance()->get_item($album_id) ?>
	<a href="/groups/photo?id=<?=$group['id']?>&album_id=<?=$album_id?>"><?=group_helper::media_photo($screen_id, 'ma')?></a><br />
	<a href="/groups/photo?id=<?=$group['id']?>&album_id=<?=$album_id?>"><?= $album_id ? htmlspecialchars($album['title']) : t('Основной альбом') ?></a>
</div>