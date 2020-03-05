<? $poll = polls_peer::instance()->get_item($id) ?>

<div class="left"><?=user_helper::photo($poll['user_id'], 's', array('class' => 'border1'))?></div>
<div class="left ml10" style="width: 360px;">
	<a href="/poll<?=$id?>"><?=htmlspecialchars($poll['question'])?></a>
	<div class="fs11 quiet mb5">
		<?=user_helper::full_name($poll['user_id'])?><br />
		<?=date_helper::human($poll['created_ts'], ', ')?><br />
		<?=t('Количество проголосовавших')?>: <b><?=$poll['count']?></b>
	</div>
	<? if ( !polls_votes_peer::instance()->has_voted($id, session::get_user_id()) ) { ?>
		<a class="fs11" href="/poll<?=$id?>"><?=t('Голосовать')?>...</a>
	<? } else { ?>
		<a class="fs11" href="/poll<?=$id?>"><?=t('Смотреть результаты')?></a>
	<? } ?>
</div>
<div class="clear"></div><br />
