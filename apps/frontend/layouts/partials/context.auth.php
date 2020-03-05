<? if ( session::is_authenticated() ) { ?>
	<div style="background: #F7F7F7;" class="mt10 p10 ml10">
		<div class="left mt5 fs11 quiet acenter" style="width: 60px;">
			<?=user_helper::photo(session::get_user_id(), 's', array('class' => 'border1'))?>
			<div>
				<? $auth_user = user_data_peer::instance()->get_item(session::get_user_id())?>
				<?=t('Опыт');?><br /><b><?=number_format($auth_user['rate'], 2)?></b>
			</div>
		</div>
		<div class="left personal_menu">
			<a class="bold" href="/profile-<?=session::get_user_id()?>"><?=t('Мой Профиль');?></a>
			<a href="/blog-<?=session::get_user_id()?>"><?=t('Мой блог');?></a>
			<a href="/debates/mine"><?=t('Мои дебаты');?></a>
			<a href="/parties/mine"><?=t('Моя партия');?></a>
			<a href="/groups/mine"><?=t('Мои группы');?></a>
			<a href="/friends/invite"><?=t('Пригласить');?></a>
		</div>
		<div class="left personal_menu" style="margin-left: 5px; margin-top: 2px;">
			<a href="/friends" <?=$pending_friends ? 'class="bold maroon"' : ''?>><?=t('Друзья');?></a>
			<a href="/messages" <?=$new_messages ? 'class="bold maroon"' : ''?>><?=t('Сообщения');?></a>
			<a href="/feed" <?=feed_peer::has_updates(session::get_user_id()) ? 'class="bold maroon"' : ''?>><?=t('Обновления');?></a>
			<a href="/bookmarks"><?=t('Закладки');?></a>
			<a href="/profile/edit?tab=settings" class="mr10"><?=t('Настройки');?></a>
			<a href="/sign/out" class="quiet"><?=t('Выйти');?></a>
		</div>
		<div class="clear"></div>

	</div>
<? } else { ?>
	<div class="ml10 mt10 p5 acenter fs12" style="border: 1px solid #E4E4E4; background: #F7F7F7;">
		<a href="/"><?=t('Войти на сайт');?></a> <? /* <?=t('либо');?> <a href="/sign/up"><?=t('зарегистрироваться');?></a>*/ ?>
	</div>

	<div class="m10">
		<a href="/" title="Politiko"><b>Politiko</b></a> – <?=t('первая украинская политическая социальная сеть, объединяющая политиков, экспертов, журналистов, лидеров партий и избирателей Украины в рамках одного сообщества.')?><br />
	</div>
<? } ?>
