<? if ( !$id ) { ?>
	<?=t('Против всех')?>
<? } else { ?>
	<? $rating = candidates_votes_peer::instance()->get_rating(); ?>
	<div class="left">
		<?=user_helper::photo($id, 't');?>
	</div>
	<div style="margin-left: 80px;">
		<h4 class="mb5"><?=user_helper::full_name($id);?></h4>
		<?=t('Место')?>:
		<? foreach ( $rating as $i => $line ) if ( $id == $line['id'] ) { ?>
			<b><?=$i+1?></b>
		<? break; } ?>
	</div>
<? } ?>