<h1 class="column_head mr10 mt10"><a href="/polls"><?=t('Опросы')?></a> &rarr; <?=t('Просмотр')?></h1>
<? $has_voted = polls_votes_peer::instance()->has_voted($poll_id, session::get_user_id()); ?>

<div>
	<?=user_helper::photo($poll['user_id'], 't', array('class' => 'border1 mr10', 'align' => 'left'))?>
	<div class="left" style="width: 590px;">
		<h4 class="mb5"><?=nl2br(htmlspecialchars($poll['question']))?></h4>
		<? if ( session::has_credential('moderator') ) { ?>
			<a href="/polls/hide?id=<?=$poll['id']?>" class="fs11"><?=t('Скрыть')?></a>
			<a href="/polls/promote?id=<?=$poll['id']?>" class="ml10 fs11"><?=t('Сделать важным')?></a>
		<? } ?>
		<div class="fs11 left">
			<span class="quiet"><?=date_helper::human($poll['created_ts'], ', ')?></span><br />
			<?=user_helper::full_name($poll['user_id'])?>
		</div>
		<? if ( session::is_authenticated() ) { ?>
			<?=user_helper::share_item('poll', $poll['id'], array('class' => 'right'))?>
		<? } ?>
		<div class="clear"></div>
	</div>
</div>

<div class="clear mb10"></div>

<form action="/polls/vote" rel="<?=$poll_id?>" onsubmit="pollsController.vote( this ); return false;">
	<input type="hidden" name="poll_id" value="<?=$poll_id?>">
	<div class="mb5" id="results_<?=$poll_id?>">
		<? if ( !$has_voted ) { ?>
			<div class="mb10 ml5 quiet fs11"><?=t('Вы сможете увидеть результаты после того, как проголосуете')?></div>
			<? if ( $poll['is_multi'] ) { ?>
				<div class="mb10 ml5 quiet fs11"><?=t('Вы можете выбрать несколько вариантов ответов')?></div>
			<? } ?>
			<? $answers = polls_answers_peer::instance()->get_by_poll($poll_id); ?>
			<? foreach ( $answers as $answer_id ) { ?>
				<? $answer = polls_answers_peer::instance()->get_item($answer_id) ?>
				<div class="p5 mr10" style="border: 1px solid #FFF;">
					<div class="left">
						<? if ( $poll['is_multi'] ) { ?>
							<input type="checkbox" name="answer[<?=$answer['id']?>]" id="answer_<?=$answer['id']?>" value="1" />
						<? } else { ?>
							<input type="radio" name="answer" id="answer_<?=$answer['id']?>" value="<?=$answer['id']?>" />
						<? } ?>
					</div>
					<label class="ml5 left" style="width: 635px;" for="answer_<?=$answer['id']?>"><?=htmlspecialchars($answer['answer'])?></label>
					<div class="clear"></div>
				</div>
			<? } ?>

			<? if ( $poll['is_custom'] ) { ?>
				<div class="p5 mr10" style="border: 1px solid #FFF;">
					<div class="left">
						<? if ( $poll['is_multi'] ) { ?>
							<input type="checkbox" name="answer_custom" id="answer_custom" value="1" />
						<? } else { ?>
							<input type="radio" name="answer" id="answer_custom" value="custom" />
						<? } ?>
					</div>
					<div class="ml5 left" style="width: 635px;">
						<label style="display:block;" for="answer_custom" class="mb5"><?=t('Свой вариант')?></label>
						<textarea name="custom" style="width: 500px; height: 50px;"></textarea>
					</div>
					<div class="clear"></div>
				</div>
			<? } ?>

		<? } else { ?>

			<?
			$answers_list = polls_answers_peer::instance()->get_by_poll($poll_id);
			$answers = array();
			$max_count = 0;
			foreach ( $answers_list as $answer_id ) {
				$answer = polls_answers_peer::instance()->get_item($answer_id);
				$answers[] = $answer;
				if ( $max_count < $answer['count'] ) { $max_count = $answer['count']; };
			}
			?>

			<div style="border: 1px solid #EEE; background: #FAFAFA;" class="mr10 mb10 p5 quiet fs11 acenter">
				<?=t('Общее количество проголосовавших')?>: <?=$poll['count']?>,
				<?=t('голосование длиться')?> <?=floor((time() - $poll['created_ts'])/3600)?> <?=t('часов')?>
			</div>

			<? foreach ( $answers as $i => $answer ) { ?>
				<div class="left" style="width: 25px;"><?=$i+1?>.</div>
				<div class="left fs11" style="width: 150px;">
					<div><?=htmlspecialchars($answer['answer'])?></div>
					<div class="fs11 mb5 quiet"><?=t('Голосов')?>: <b><?=(int)$answer['count']?></b></div>
					<? if ( session::has_credential('admin') ) { ?>
						<a href="polls/voters?id=<?=$poll['id']?>&answer=<?=$answer['id']?>">Список голосовавших &rarr;</a>
					<? } ?>
				</div>
				<div class="left mt10">
					<div class="mb10 mr10" style="width: <?=ceil($answer['count']/max($max_count, 1)*500)?>px; background: #DDEEDD; border: 1px solid #AACCAA; height: 5px;"></div>
				</div>
				<div class="clear mb5"></div>
			<? } ?>

			<? if ( $poll['is_custom'] && $custom_list ) { ?>
				<div class="left" style="width: 25px;">&nbsp;</div>
				<div class="left fs11" style="width: 665px;">
					<br/>
					<h4 class="mb10"><?=t('Другие варианты ответов')?>:</h4>
					<ul>
						<? foreach ( $custom_list as $custom ) { ?>
							<li>
								<?=htmlspecialchars($custom['text'])?><br/>
								<span class="fs11 mb5 quiet"><?=t('Голосов')?>: <b><?=(int)$custom['total']?></b></span>
								<? if ( session::has_credential('admin') ) { ?>
									<a href="polls/delete_custom?id=<?=$poll['id']?>&answer=<?=urlencode($custom['text'])?>">X</a>
								<? } ?>
							</li>
						<? } ?>
					</ul>
					<? if ( session::has_credential('admin') ) { ?>
						<a href="polls/voters?id=<?=$poll['id']?>">Список голосовавших &rarr;</a>
					<? } ?>
				</div>
				<div class="clear mb5"></div>
			<? } ?>

		<? } ?>
	</div>
	<? if ( !$has_voted ) { ?>
		<input id="submit_<?=$id?>" type="submit" class="button" value=" <?=t('Голосовать')?> ">
		<?=tag_helper::wait_panel('wait_' . $poll_id)?>
	<? } ?>
</form>

<div class="mr10 mt10">
	<h3 class="column_head"><?=tag_helper::image('common/comments.png', array('class' => 'vcenter'))?> <?=t('Комментарии')?></h3>

	<div class="mt10 mb10" id="comments">
		<? if ( !$comments ) { ?>
			<div id="no_comments" class="acenter fs11 quiet"><?=t('Нет комментариев')?></div>
		<? } else { ?>
			<? foreach ( $comments as $id ) { include 'partials/comment.php'; } ?>
		<? } ?>
	</div>

	<? if ( session::is_authenticated() ) { ?>
			<form class="form_bg" id="comment_form" action="/polls/comment">
				<h3 class="column_head_small mb5"><?=t('Добавить комментарий')?></h3>
				<div class="ml10 mr10 mb10">
					<input type="hidden" name="poll_id" value="<?=$poll_id?>"/>
					<textarea rel="<?=t('Напишите текст')?>" style="width: 99%; height: 75px;" name="text"></textarea>
					<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
					<?=tag_helper::wait_panel()?>
				</div>
			</form>

			<form id="comment_reply_form" class="hidden" action="/polls/comment">
				<input type="hidden" name="poll_id" value="<?=$poll_id?>"/>
				<input type="hidden" name="parent_id"/>
				<textarea rel="<?=t('Напишите текст')?>" style="width: 99%; height: 50px;" name="text"></textarea>
				<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
				<?=tag_helper::wait_panel()?>
				<input type="button" class="button_gray" value="<?=t('Отмена')?>" onclick="$('#comment_reply_form').hide();">
			</form>
	<? } else { ?>
		<?=user_helper::login_require( t('Войдите на сайт, что-бы оставить комментарий') )?>
	<? } ?>
</div>