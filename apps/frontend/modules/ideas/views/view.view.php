<h1 class="column_head mt10 mr10 mb5">
	<a href="/ideas"><?=t('Идеи')?></a>
	&rarr; <?=htmlspecialchars($idea['title'])?>
</h1>

<?=user_helper::photo($idea['user_id'], 't', array('class' => 'border1 mr10', 'align' => 'left'))?>
<div class="left" style="width: 590px;">
	<div class="fs12 mb5">
		<a href="/ideas/index?segment=<?=urlencode(ideas_peer::get_segment_name($idea['segment']))?>"><?=ideas_peer::get_segment_name($idea['segment'])?></a>
	</div>
	<? if ( session::has_credential('moderator') ) { ?>
		<a href="/ideas/hide?id=<?=$idea['id']?>" class="fs11"><?=t('Скрыть')?></a>
	<? } ?>
	<div class="fs11 left">
		<span class="quiet"><?=date_helper::human($idea['created_ts'], ', ')?></span><br />
		<?=user_helper::full_name($idea['user_id'])?>
	</div>
	<? if ( session::is_authenticated() ) { ?>
		<?=user_helper::share_item('idea', $idea['id'], array('class' => 'right'))?>
	<? } ?>
	<div class="clear"></div>

	<div class="fs12 mb10 mt10 p5 acenter" style="background: #FAFAFA; border: 1px solid #EEE;" id="rate_pane">
		<?=tag_helper::image('common/up.gif', array('class' => 'vcenter'))?> <?=t('Идею поддерживают')?>: <b id="rate"><?=$idea['rate']?></b>
		<? if (session::is_authenticated() && !ideas_peer::instance()->has_voted($idea['id'], session::get_user_id()) ) { ?>
			<a class="ml10 bold dotted" href="javascript:;" onclick="ideasController.rateIdea(<?=$idea['id']?>);"><?=t('Поддержать')?></a>
		<? } ?>
	</div>

	<div><?=nl2br(htmlspecialchars($idea['text']))?></div><br />

	<h3 class="column_head">
		<?=tag_helper::image('common/comments.png', array('class' => 'vcenter'))?> <?=t('Комментарии')?>
	</h3>

	<div class="mt10 mb10" id="comments">
		<? if ( !$comments ) { ?>
			<div id="no_comments" class="acenter fs11 quiet"><?=t('Нет комментариев')?></div>
		<? } else { ?>
			<? foreach ( $comments as $id ) { include 'partials/comment.php'; } ?>
		<? } ?>
	</div>
	<? if ( session::is_authenticated() ) { ?>
		<form class="form_bg" id="comment_form" action="/ideas/comment">
			<h3 class="column_head_small mb5"><?=t('Добавить комментарий')?></h3>
			<div class="ml10 mr10 mb10">
				<input type="hidden" name="idea_id" value="<?=$idea['id']?>"/>
				<textarea rel="<?=t('Напишите текст')?>" style="width: 99%; height: 75px;" name="text"></textarea>
				<input type="submit" name="submit" class="mt5 mb5 button" value=" <?=t('Отправить')?> " />
				<?=tag_helper::wait_panel()?>
			</div>
		</form>

		<form id="comment_reply_form" class="hidden" action="/ideas/comment">
			<input type="hidden" name="idea_id" value="<?=$idea['id']?>"/>
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