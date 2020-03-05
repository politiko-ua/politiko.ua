<? $user_data = user_data_peer::instance()->get_item($id) ?>
<? if ( $party_id = parties_members_peer::instance()->get($id) ) {
	$party = parties_peer::instance()->get_item($party_id);
} else { $party = null; } ?>
<div class="box_content p10 mb10">
	<?=user_helper::photo($id, 't', array('class' => 'border1 left'))?>
	<div style="margin-left: 85px;">
		<?=user_helper::full_name($id)?>

		<? $rate_offset = ceil( $user_data['rate']/10 ) + 2 ?>
		<div class="rate mt10 mr10" style="width: 200px;"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Опыт')?>: <?=number_format($user_data['rate'], 2)?></div></div>

		<div class="fs11 mt5">
			<span class="right"><?=t('Поддерживают')?>: <b><?=$user_data['trust']?></b></span>
			
			<span class="left">
				<?=t('Партия')?>:
				<?=$party ? '<a href="/party' . $party['id'] . '">' . htmlspecialchars($party['title']) . '</a>' : '-'?>
			</span>

			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
