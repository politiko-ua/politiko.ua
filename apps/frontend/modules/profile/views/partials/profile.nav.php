<div style="text-align:center; margin-bottom: 5px;">
	<?=user_helper::photo($user_data['user_id'], 'p', array('class' => 'border1', 'alt' => htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name']) ), false)?>
</div>

<div style="width: 200px; margin: auto;">
	<? $rate_offset = ceil( $user_data['rate']/10 ) + 2 ?>
	<div class="rate"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Опыт')?>: <?=number_format($user_data['rate'], 2)?></div></div>

	<? if ( session::is_authenticated() ) { ?>
		<div class="profile_menu">
			<? if ( session::get_user_id() != $user['id'] ) { ?>
				<a href="/messages/compose?user_id=<?=$user['id']?>"><?=t('Написать')?></a>
				<? if ( !friends_pending_peer::instance()->is_pending($user['id'], session::get_user_id()) && !friends_peer::instance()->is_friend(session::get_user_id(), $user['id']) ) { ?>
					<a href="javascript:;" id="menu_add_friends" onclick="Application.addToFriends(<?=$user['id']?>);"><?=t('Добавить в друзья')?></a>
				<? } ?>

				<? if ( !user_blacklist_peer::is_banned(session::get_user_id(), $user['id']) ) { ?>
					<a href="javascript:;" id="menu_blacklist" onclick="Application.addToBlacklist(<?=$user['id']?>);"class="bad"><?=t('В черный список')?></a>
				<? } ?>
			<? } ?>
		</div>
	<? } ?>
	
	<? if ( $user['type'] == user_auth_peer::TYPE_POLITIC ) { ?>
		<br /><div class="column_head_small"><?=t('Поддержка политика')?></div>
		<div class="fs11 pb5" style="background: #F7F7F7;">
			<div class="mr10 pt5 ml10 acenter">
				<?=t('Вы поддерживаете этого политика?')?>
				<div class="acenter m5 quiet" style="text-decoration: none;">
					<?=t('Поддерживают')?>:
					<span id="trust_value" class="bold"><?=$user_data['trust']?></span>
				</div>
				<? if ( session::is_authenticated() ) { ?>
					<a id="trust" onclick="<?=$have_trusted && $my_trust ? 'return false;' : ''?>profileController.trust(<?=$user_data['user_id']?>, true);" class="left custom_rate <?=$have_trusted && $my_trust ? 'custom_rate_selected' : ''?>" href="javascript:;">
						<?=tag_helper::image('common/up.gif')?><br />
						<?=t('Да')?>
					</a>
					<a id="not_trust" onclick="<?=$have_trusted && !$my_trust ? 'return false;' : ''?>profileController.trust(<?=$user_data['user_id']?>, false);" class="right custom_rate <?=$have_trusted && !$my_trust ? 'custom_rate_selected' : ''?>" href="javascript:;">
						<?=tag_helper::image('common/down.gif')?><br />
						<?=t('Нет')?>
					</a>
				<? } ?>
			</div>
			<? if ( session::is_authenticated() ) { ?>
				<div class="clear"></div>
				<div class="acenter fs11 quiet m10"><?=t('Вы в любой момент сможете изменить свою позицию по отношению к этому политику')?></div>
			<? } ?>
		</div>

		<? if ( !session::is_authenticated() ) { ?>
			<?=user_helper::login_require( t('Войдите на сайт, что-бы высказать свое мнение') )?>
		<? } ?>

	<? } ?>

	<? if ( $party ) { ?>
		<br /><div class="column_head_small"><?=t('Моя партия')?></div>
		<div class="box_content p10 acenter">
			<?=party_helper::photo($party['id'], 't', true, array('class' => 'mt10 border1'))?><br />
			<a href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
		</div>
	<? } ?>

	<? if ( $groups ) { ?>
		<br /><div class="column_head_small mt10"><?=t('Мои группы')?></div>
		<? foreach ( $groups as $id ) { ?>
			<? $group = groups_peer::instance()->get_item($id) ?>
				<div class="box_content p10 fs11 mb10">
					<div class="left"><?=group_helper::photo($group['id'], 's', true, array('class' => 'border1'))?></div>
					<div style="margin-left: 60px;">
						<a href="/group<?=$group['id']?>"><?=$group['title']?></a>
						<div class="mt5 quiet fs11"><?=groups_peer::get_type($group['type'])?></div>
					</div>
					<div class="clear"></div>
				</div>
		<? } ?>
	<? } ?>

</div>