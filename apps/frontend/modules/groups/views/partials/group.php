<? $group = groups_peer::instance()->get_item($id) ?>

<div class="mb10 p10 box_content">
	<div class="left"><?=group_helper::photo($group['id'], 't', true, array('class' => 'border1'))?></div>
	<div style="margin-left: 85px;" class="ml10">
		<a href="/group<?=$group['id']?>"><?=$group['title']?></a>
		<div class="mt5 quiet fs11">
			<?=groups_peer::get_type($group['type'])?>
			<? if ( groups_peer::instance()->is_moderator($group['id'], session::get_user_id()) ) { ?>
				<a class="ml10 bold" href="/groups/edit?id=<?=$group['id']?>"><?=t('Редактировать')?></a>
			<? } ?>
		</div>
		<? $rate_offset = ceil( $group['rate'] ) + 2 ?>
			<div class="rate mt10"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Рейтинг')?>: <?=number_format($group['rate'], 2)?></div></div>
	</div>
	<div class="clear"></div>
</div>