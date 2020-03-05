<? if ( $user_data['bio'] ) { ?>
	<div class="content_pane hide" id="pane_bio">
		<? if ( session::get_user_id() == $user['id'] ) { ?>
			<div class="pl5 pt5 mb5 pb5 fs11" style="background: #F7F7F7">
				<a class="ml10" href="/profile/edit"><?=t('Редактировать биографию')?></a>
			</div>
		<? } ?>
		<p class="fs12 mt10"><?=htmlspecialchars($user_data['bio'])?></p>
	</div>
<? } ?>