<div class="mb10">
	<?=user_helper::full_name($leader_id)?>
	<a class="ml10 fs10 quiet" href="javascript:;" rel="<?=$leader_id?>" onclick="partiesController.deleteLeader(this);"><?=t('Удалить')?></a>
</div>