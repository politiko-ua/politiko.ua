<div class="profile">
	<div class="left" style="width: 230px; padding-top: 10px;">
		<? include 'partials/profile.nav.php' ?>
	</div>

	<div class="left" style="width: 450px; padding-top: 10px;">
		<? include 'partials/profile.head.php' ?>

		<div class="tab_pane">
			<a rel="blog" href="javascript:;" class="selected"><?=t('Блог')?></a>
			<? if ( $user_data['bio'] ) { ?>
				<a rel="bio" href="javascript:;"><?=t('Биография')?></a>
			<? } ?>
			<? if ( $candidate['program'] ) { ?>
				<a rel="program" href="javascript:;"><?=t('Програма')?></a>
			<? } ?>
			<a rel="debates" href="javascript:;"><?=t('Дебаты')?></a>
			<a rel="polls" href="javascript:;"><?=t('Опросы')?></a>
			<a rel="ideas" href="javascript:;"><?=t('Идеи')?></a>
			<div class="clear"></div>
		</div>

		<? include 'partials/boxes/blogs.php' ?>
		<? include 'partials/boxes/bio.php' ?>
		<? include 'partials/boxes/program.php' ?>
		<? include 'partials/boxes/debates.php' ?>
		<? include 'partials/boxes/polls.php' ?>
		<? include 'partials/boxes/ideas.php' ?>
	</div>

	<div class="clear"></div>
</div>

<? if ( $user['id'] == session::get_user_id() ) { ?>
	<div class="box_content fs10 p5 mr10 quiet">
		<?=t('Ссылка на мой профиль')?>:
		<input readonly class="quiet" onclick="this.select();" style="border:0px; width: 510px; background: #FAFAFA; font-size: 11px;" type="text" value="<?=htmlspecialchars('<a href="https://' . context::get('host') . '/profile-' . $user['id'] . '">Я на Политико.com.ua</a>')?>" />
	</div>
<? } ?>