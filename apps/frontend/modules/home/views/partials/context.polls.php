<div class="ml10 mt10">
	<h1 class="column_head mt10">
		<span class="left"><?=t('Опросы')?></span>
		<a class="right fs11" href="/polls"><?=t('Все')?></a>
		<div class="clear"></div>
	</h1>
	<? foreach ( $new_polls as $id ) { ?>
		<? $poll = polls_peer::instance()->get_item($id) ?>

		<div class="p10 box_content mb10">
			<div class="fs10 left acenter" style="width: 60px">
				<?=user_helper::photo($poll['user_id'], 's', array('class' => 'border1'))?><br />
				<?=user_helper::full_name($poll['user_id'])?>
			</div>
			<div class="left ml5" style="width: 210px;">
				<? $question = explode(' ', $poll['question']); ?>
				<? $question = implode(' ', array_slice($question, 0, 32)) ?>
				<a href="/poll<?=$id?>"><?=htmlspecialchars($question)?></a>
				<div class="fs11 quiet mb5">
					<?=date_helper::human($poll['created_ts'], ', ')?><br />
					 <?=t('Количество проголосовавших')?>: <b><?=$poll['count']?></b>
				</div>
				<? if ( !polls_votes_peer::instance()->has_voted($id, session::get_user_id()) ) { ?>
					<a class="fs11 bold" href="/poll<?=$id?>"> <?=t('Голосовать')?> &rarr;</a>
				<? } else { ?>
					<a class="fs11" href="/poll<?=$id?>"> <?=t('Смотреть результаты')?> &rarr;</a>
				<? } ?>
			</div>
			<div class="clear"></div>
		</div>
	<? } ?>

	<div class="box_content p5">
		<a class="fs11" href="/polls"><?=t('Все опросы')?> &rarr;</a>
	</div>
</div>