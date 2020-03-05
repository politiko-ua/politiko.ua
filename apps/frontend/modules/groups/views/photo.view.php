<h1 class="mt10 mr10 column_head">
	<a href="/group<?=$group['id']?>"><?=htmlspecialchars($group['title'])?></a> &rarr <?=t('Фото')?>
</h1>

<? if ( groups_members_peer::instance()->is_member($group['id'], session::get_user_id()) ) { ?>
	<div class="form_bg mr10 fs12 p10 mb10">
		<div class="left">
			<? if ( $album_id !== null ) { ?>
				<a href="/groups/photo?id=<?=$group['id']?>"><?=t('Фотоальбомы группы')?></a> &rarr;
				<?= $album ? htmlspecialchars($album['title']) : t('Основной альбом') ?>
			<? } else { ?>
				<?=t('Фотоальбомы группы')?>
			<? } ?>
		</div>
		<a href="/groups/photo_add?id=<?=$group['id']?>&album_id=<?=$album_id?>" class="right"><?=t('Загрузить фото')?></a>
		<div class="clear"></div>
	</div>
<? } ?>

<? if ( $album_id !== null ) { ?>
	<? if ( $photos ) { ?>
		<? foreach ( $photos as $id ) { include 'partials/photo.php'; } ?>
		<div class="clear"></div><br />
		<div class="bottom_line_d mb10 mr10"></div>
		<div class="right pager mr10"><?=pager_helper::get_full($pager)?></div>
	<? } else { ?>
		<div class="acenter fs12 p5 ml10"><?=t('Фотографий еще нет')?></div>
	<? } ?>
<? } else { ?>
	<? foreach ( $albums as $album_id ) { include 'partials/album.php'; } ?>
<? } ?>