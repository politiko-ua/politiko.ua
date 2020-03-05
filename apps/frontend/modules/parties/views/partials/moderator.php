<div class="mb10">
	<?=user_helper::full_name($moderator_id)?>
	<a class="ml10 fs10 quiet" href="javascript:;" rel="<?=$moderator_id?>" onclick="partiesController.deleteModerator(this);"><?=t('Удалить')?></a>
	<? if ( $party['user_id'] == session::get_user_id() ) { ?>
		<a class="ml10 fs10 quiet bold" href="javascript:;" rel="<?=t('Передать полномочия администратора этому пользователю?')?>" onclick="partiesController.changeOwner(<?=$moderator_id?>, this);"><?=t('Передать полномочия')?></a>
	<? } ?>
</div>