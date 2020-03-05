<div <?= ( $post_data['sort_ts'] > $post_data['created_ts'] ) ? 'style="background:#EBFFEC;border: 1px solid #EBEEEC"' : '' ?>>

<div class="left mr10 acenter" style="width: 70px;">
	<?=user_helper::photo($post_data['user_id'], 's', array('class' => 'mt5 border1'))?>
	<div class="mb5 acenter">
		<span class="green"><?=$post_data['for']?></span>
		<span class="red ml5"><?=$post_data['against']?></span>
	</div>
	<div class="quiet fs10 mb10 acenter"><?=date_helper::human($post_data['created_ts'])?></div>

</div>
<div style="margin-left: 80px;">
	<h5 class="mb5"><a href="/blogpost<?=$post_data['id']?>"><?=htmlspecialchars($post_data['title'])?></a></h5>
	<div class="fs12">
		<div class="mb10"><?=$post_data['preview']?></div>
		<div class="p5" style="background: #F7F7F7;">
			<a style="margin-right: 25px;" href="/blogpost<?=$post_data['id']?>" class="fs11"><?=t('Читать дальше')?> &rarr;</a>
			<a href="/blogpost<?=$post_data['id']?>#comments" class="fs11"><?=t('Комментариев')?>: <?=blogs_comments_peer::instance()->get_count_by_post($post_data['id'])?></a>
		</div>
	</div>
</div>

<div class="clear mb5"></div>
</div>

<br />
