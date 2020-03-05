<? $question = user_questions_peer::instance()->get_item($id) ?>
<div class="fs11 p10 ml10 mb10" style="background: #F7F7F7;">
	<?=user_helper::full_name($question['user_id'], true)?>: 
	<?=nl2br(htmlspecialchars($question['text']))?>
	<? if ( $question['reply'] ) { include 'question_reply.php'; } ?>
</div>