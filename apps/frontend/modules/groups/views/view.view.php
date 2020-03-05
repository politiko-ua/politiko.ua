<div class="profile">
	<div class="left" style="width: 230px; padding-top: 10px;">
		<div style="text-align:center; margin-bottom: 5px;">
			<?=group_helper::photo($group['id'], 'p', false, array('class' => 'border1'))?>
		</div>

		<div style="width: 200px; margin: auto;">
			<? $rate_offset = ceil( $group['rate'] ) + 2 ?>
			<div class="rate"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Рейтинг')?>: <?=number_format($group['rate'], 2)?></div></div>

			<div class="profile_menu">
				<? if ( session::is_authenticated() ) { ?>
					<? if ( $group['privacy'] == groups_peer::PRIVACY_PUBLIC ) { ?>
						<a id="menu_join" href="javascript:;" style="<?=$is_member ? 'display:none;' : ''?>" onclick="groupsController.join(<?=$group['id']?>);"><?=tag_helper::image('icons/check.png', array('class' => 'vcenter mr5'))?><?=t('Вступить')?></a>
					<? } ?>
					<? if ( $group['user_id'] != session::get_user_id() ) { ?>
						<a id="menu_leave" href="javascript:;" style="<?=!$is_member ? 'display:none;' : ''?>" onclick="groupsController.leave(<?=$group['id']?>);"><?=tag_helper::image('icons/delete.png', array('class' => 'vcenter mr5'))?><?=t('Покинуть')?></a>
					<? } ?>
				<? } ?>
			</div>

			<? if ( !$privacy_closed ) { ?>
				<br /><div class="column_head_small"><?=t('Основатель группы')?></div>
				<div class="fs11 p10 box_content acenter">
					<?=user_helper::photo($group['user_id'], 't', array('class' => 'border1'))?><br />
					<?=user_helper::full_name($group['user_id'])?>
				</div>

				<? if ( $news ) { ?>
					<br />
					<div class="column_head_small">
						<span class="left"><?=t('Новости')?></span>
						<a href="/groups/news?id=<?=$group['id']?>" class="fs11 right"><?=t('Все')?></a>
						<div class="clear"></div>
					</div>
					<div class="fs11 pb5" style="background: #F7F7F7;">
						<div class="fs11 ml5 white bold"></div>
						<div class="fs11 p5">
							<div class="mb5 quiet"><?=date_helper::human($news['created_ts'], ', ')?></div>
							<?=nl2br(htmlspecialchars($news['text']))?>
						</div>
					</div>
				<? } ?>
			<? } ?>

		</div>
	</div>

	<div class="left" style="width: 450px; padding-top: 10px;">
		<h3 class="mb5" style="height: 60px; overflow: hidden;">
			<?=htmlspecialchars($group['title'])?>
		</h3>
		<div class="left fs11 quiet bold">
			<?=t('Группа')?>
			<? if ( groups_peer::instance()->is_moderator($group['id'], session::get_user_id()) ) { ?>
				<a href="/groups/edit?id=<?=$group['id']?>" class="ml10 fs11"><?=t('Редактировать')?></a>
			<? } ?>

			<? if ( session::has_credential('admin') ) { ?>
				<a href="/admin/groups?key=<?= $group['id'] ?>" class="ml10 fs11"><?=t('Администрирование')?></a>
			<? } ?>
		</div>
		<? if ( !$privacy_closed ) { ?>
			<? if ( session::is_authenticated() ) { ?>
				<?=user_helper::share_item('group', $group['id'], array('class' => 'right'))?>
			<? } ?>
		<? } ?>
		<div class="clear"></div>

		<? if ( !$privacy_closed ) { ?>
			<table class="fs12 mt10">
				<tr><td width="35%;" class="bold aright"><?=t('Категория')?></td><td><?=groups_peer::get_type($group['type'])?></td></tr>
				<tr><td width="35%;" class="bold aright"><?=t('Территория')?></td><td><?=groups_peer::get_teritory($group['teritory'])?></td></tr>
				<tr><td width="35%;" class="bold aright"><a href="/groups/members?id=<?=$group['id']?>"><?=t('Количество учасников')?></a></td><td><?=count($members)?></td></tr>
				<? if ( $group['url'] ) { ?>
					<tr><td class="bold aright"><?=t('Web сайт')?></td><td><a rel="nofollow" target="_blank" href="https://<?=$group['url']?>"><?=htmlspecialchars($group['url'])?></a></td></tr>
				<? } ?>
			</table>
			<br />
			<div class="tab_pane">
				<a rel="talk" href="javascript:;" class="selected"><?=t('Обсуждения')?></a>
				<a rel="description" href="javascript:;"><?=t('Описание')?></a>
				<a rel="aims" href="javascript:;"><?=t('Цели')?></a>
				<a rel="photo" href="javascript:;"><?=t('Фото')?></a>
				<div class="clear"></div>
			</div>

			<div id="pane_description" class="content_pane hidden">
				<? if ( $group['description'] ) { ?>
					<div class="m5 fs12"><?=nl2br(htmlspecialchars($group['description']))?></div>
				<? } else { ?>
					<div class="m5 acenter fs12"><?=t('Описания еще нет')?></div>
				<? } ?>
			</div>

			<div id="pane_aims" class="content_pane hidden">
				<? if ( $group['aims'] ) { ?>
					<div class="m5 fs12"><?=nl2br(htmlspecialchars($group['aims']))?></div>
				<? } else { ?>
					<div class="m5 acenter fs12"><?=t('Цели еще не определены')?></div>
				<? } ?>
			</div>

			<div id="pane_photo" class="content_pane hidden">
				<div class="box_content p5 mb10 fs11"><a href="/groups/photo?id=<?=$group['id']?>"><?=t('Фотоальбомы группы')?> &rarr;</a></div>
				<? if ( $photos ) { ?>
					<div class="m5 fs12">
						<? foreach ( $photos as $photo_id ) { ?>
							<a class="left acenter mb10 ml10" href="/groups/photo_view?id=<?=$photo_id?>"><?=group_helper::media_photo($photo_id, 't')?></a>
						<? } ?>
					</div>
				<? } else { ?>
					<div class="m5 acenter fs12">
						<?=t('Фотографий еще нет')?>
						<? if ( $is_member ) { ?>
							<br />
							<a href="/groups/photo_add?id=<?=$group['id']?>"><?=t('Добавить фото')?></a>
						<? } ?>
					</div>
				<? } ?>
			</div>

			<div id="pane_talk" class="content_pane">
			<div class="box_content p5 mb10 fs11"><a href="/groups/talk?id=<?=$group['id']?>"><?=t('Все обсуждения')?> &rarr;</a></div>
			<? if ( !$talks ) { ?>
				<div class="m5 acenter fs12"><?=t('Обсуждения еще не велись')?></div>
			<? } else {?>
				<? foreach ( $talks as $id ) { ?>
					<? $topic = groups_topics_peer::instance()->get_item($id) ?>
					<div class="mb10 box_content p10 mr10" id="comment<?=$id?>">
						<div class="mb5 bold fs12">
							<a href="/groups/talk_topic?id=<?=$id?>"><?=htmlspecialchars($topic['topic'])?></a>
						</div>
						<div class="fs11 pb5">
							<div class="left quiet">
								<?=t('Всего сообщений')?>:
								<b><?=$topic['messages_count']?></b>,
								<?=t('Последнее')?>:
								<a href="/groups/talk_topic?id=<?=$id?>&last=1"><?=date_helper::human($topic['updated_ts'], ', ')?> &rarr;</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				<? } ?>
			<? } ?>
			</div>
		<? } else { ?>
			<div class="screen_message acenter bold">
				<?=t('Это приватная группа, для доступа к содержимому Вам необходимо вступить в нее')?>

				<br/><br />
				<? if ( session::is_authenticated() ) { ?>
					<? if ( !groups_applicants_peer::instance()->is_applicant($group['id'], session::get_user_id()) ) { ?>
						<input id="menu_apply" type="button" class="button" value="<?=t('Вступить')?>" onclick="groupsController.apply(<?=$group['id']?>);" />
						<div id="text_apply" class="hidden quiet normal"><?=t('Заявка на вступление отправлена')?></div>
					<? } else { ?>
						<div class="quiet normal"><?=t('Заявка на вступление отправлена')?></div>
					<? } ?>
				<? } ?>
			</div>
		<? } ?>
	</div>
	<div class="clear"></div>
</div>
