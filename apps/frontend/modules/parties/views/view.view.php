<div class="profile">
	<div class="left" style="width: 230px; padding-top: 10px;">
		<div style="text-align:center; margin-bottom: 5px;">
			<?=party_helper::photo($party['id'], 'p', false, array('class' => 'border1'))?>
		</div>

		<div style="width: 200px; margin: auto;">
			<? if ( $party['state'] == 'old' || (session::is_authenticated() && (session::has_credential('admin') || $party['user_id'] == session::get_user_id())) ) { ?>
				<? $rate_offset = ceil( $party['rate'] ) + 2 ?>
				<div class="rate"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Рейтинг')?>: <?=number_format($party['rate'], 2)?></div></div>
				<div class="profile_menu">
					<? if ( session::is_authenticated() ) { ?>
						<? if ( !parties_members_peer::instance()->is_member(session::get_user_id(), $party['id']) ) { ?>
							<a href="javascript:;" onclick="partiesController.join(<?=$party['id']?>);">
								<?=tag_helper::image('icons/check.png', array('class' => 'vcenter mr5'))?><?=t('Вступить')?>
							</a>
						<? } else { ?>
							<a href="javascript:;" onclick="partiesController.leave(<?=$party['id']?>);">
								<?=tag_helper::image('icons/delete.png', array('class' => 'vcenter mr5'))?><?=t('Выйти из партии')?>
							</a>
						<? } ?>
					<? } ?>
				</div>
				<br /><div class="column_head_small"><?=t('Поддержка партии')?></div>
				<div class="fs11 pb5" style="background: #F7F7F7;">
					<div class="mr10 ml10 acenter">
						<?=t('Вы поддерживаете эту партию?')?>
						<div class="acenter m5 quiet" style="text-decoration: none;">
							<?=t('Поддерживают')?>:
							<span id="trust_value" class="bold"><?=$party['trust']?></span>
						</div>
						<? if ( session::is_authenticated() ) { ?>
						<a id="trust" onclick="<?=$have_trusted && $my_trust ? 'return false;' : ''?>partiesController.trust(<?=$party['id']?>, true);" class="left custom_rate <?=$have_trusted && $my_trust ? 'custom_rate_selected' : ''?>" href="javascript:;">
							<?=tag_helper::image('common/up.gif')?><br />
							<?=t('Да')?>
						</a>
						<a id="not_trust" onclick="<?=$have_trusted && !$my_trust ? 'return false;' : ''?>partiesController.trust(<?=$party['id']?>, false);" class="right custom_rate <?=$have_trusted && !$my_trust ? 'custom_rate_selected' : ''?>" href="javascript:;">
							<?=tag_helper::image('common/down.gif')?><br />
							<?=t('Нет')?>
						</a>
						<? } ?>
					</div>
					<? if ( session::is_authenticated() ) { ?>
						<div class="clear"></div>
						<div class="acenter fs11 quiet m10"><?=t('Вы в любой момент сможете изменить свою позицию по отношению к этой партии')?></div>
					<? } ?>
				</div>
	
				<? if ( !session::is_authenticated() ) { ?>
					<?=user_helper::login_require( t('Войдите на сайт, что-бы высказать свое мнение') )?>
				<? } ?>
	
				<? if ( $news ) { ?>
					<br />
					<div class="column_head_small">
						<span class="left"><?=t('Новости партии')?></span>
						<a href="/parties/news?id=<?=$party['id']?>" class="fs11 right"><?=t('Все')?></a>
						<div class="clear"></div>
					</div>
					<div class="fs11 pb5" style="background: #F7F7F7;">
						<div class="fs11 ml5 white bold"></div>
						<div class="fs11 p5">
							<div class="mb5 quiet"><?=date_helper::human($news['created_ts'], ', ')?></div>
							<?=nl2br(htmlspecialchars(text_helper::smart_trim($news['text'], 512)))?>
							&nbsp; <a href="/parties/newsread?id=<?=$news['id']?>"><?=t('Далее')?></a>
						</div>
					</div>
				<? } ?>
			<? } ?>
		</div>
	</div>

	<div class="left" style="width: 450px; padding-top: 10px;">
		<h3 class="mb5" style="height: 60px; overflow: hidden;">
			<?=htmlspecialchars($party['title'])?>
			<? if ( parties_peer::instance()->is_moderator($party['id'], session::get_user_id()) ) { ?>
				<a href="/parties/edit?id=<?=$party['id']?>" class="ml10 fs11"><?=t('Редактировать')?></a>
			<? } ?>
			<? if ( session::has_credential('admin') ) { ?>
				<a href="/admin/parties?key=<?= $party['id'] ?>" class="ml10 fs11"><?=t('Администрирование')?></a>
			<? } ?>
			<? if ( $party['state'] == 'new' && session::is_authenticated() && (session::has_credential('admin') || $party['user_id'] == session::get_user_id()) ) { ?>
				<span class="right fs11 quiet bold mt5"><?=t('Партия на модерации')?></span>
			<? } ?>
		</h3>

		<? if ( $party['state'] == 'old' || (session::is_authenticated() && (session::has_credential('admin') || $party['user_id'] == session::get_user_id())) ) { ?>
			<? if ( $contacts = unserialize($party['contacts']) ) { ?>
				<div class="left mt5">
					<? foreach ( $contacts as $type => $contact ) if ( $contact ) { ?>
						<a rel="nofollow" href="<?=htmlspecialchars($contact)?>" target="_blank"><?=tag_helper::image('/logos/' . $type . '.png', array('class' => 'vcenter mr5', 'title' => user_data_peer::get_contact_type($type)))?></a>
					<? } ?>
				</div>
			<? } ?>
	
			<div class="left fs11 quiet bold mt5"><?=t('Партия')?></div>
			
			<? if ( session::is_authenticated() ) { ?>
				<?=user_helper::share_item('party', $party['id'], array('class' => 'right'))?>
			<? } ?>
			<div class="clear"></div>
	
	
			<table class="fs12 mt10">
				<tr>
					<td class="bold aright" style="width: 40%;"><?=t('Направление')?></td>
					<td>
						<a href="/parties/index?direction=<?=urlencode(political_views_peer::get_name($party['direction']))?>"><?=political_views_peer::get_name($party['direction'])?></a>
						<? if ( ( $party['direction'] == 5 ) && $party['direction_custom'] ) { ?>
							(<?=htmlspecialchars($party['direction_custom'])?>)
						<? } ?>
					</td>
				</tr>
				<tr><td class="bold aright"><a href="/parties/members?id=<?=$party['id']?>"><?=t('Количество членов')?></a></td><td><?=count($members)?></td></tr>
				<? if ( $party['url'] ) { ?>
					<tr><td class="bold aright">Web <?=t('сайт')?></td><td><a rel="nofollow" target="_blank" href="<?=$party['url']?>"><?=htmlspecialchars($party['url'])?></a></td></tr>
				<? } ?>
			</table>
	
			<div class="pane_head"><?=t('Динамика поддержки')?></div>
			<div id="rate_history" style="z-index: 0" class="acenter m10 fs11 quiet"><?=t('Секунду, график грузится')?>...</div>
			<br />
	
			<div class="tab_pane">
				<a rel="description" href="javascript:;" class="selected"><?=t('Описание')?></a>
				<a rel="aims" href="javascript:;"><?=t('Цели')?></a>
				<a rel="program" href="javascript:;"><?=t('Программа')?></a>
				<a rel="talk" href="javascript:;"><?=t('Обсуждения')?></a>
				<div class="clear"></div>
			</div>
	
			<div id="pane_description" class="content_pane">
				<? if ( $party['description'] ) { ?>
					<div class="m5 fs12"><?=nl2br(htmlspecialchars($party['description']))?></div>
				<? } else { ?>
					<div class="m5 acenter fs12"><?=t('Описания еще нет')?></div>
				<? } ?>
			</div>
	
			<div id="pane_aims" class="content_pane hidden">
				<? if ( $party['aims'] ) { ?>
					<div class="m5 fs12"><?=nl2br(htmlspecialchars($party['aims']))?></div>
				<? } else { ?>
					<div class="m5 acenter fs12"><?=t('Цели еще не определены')?></div>
				<? } ?>
			</div>
	
			<div id="pane_talk" class="content_pane hidden">
			<div class="box_content p5 mb10 fs11"><a href="/parties/talk?id=<?=$party['id']?>"><?=t('Все обсуждения');?> &rarr;</a></div>
			<? if ( !$talks ) { ?>
				<div class="m5 acenter fs12"><?=t('Обсуждения еще не велись')?></div>
			<? } else {?>
				<? foreach ( $talks as $id ) { ?>
					<? $topic = parties_topics_peer::instance()->get_item($id) ?>
					<div class="mb10 box_content p10 mr10" id="comment<?=$id?>">
						<div class="mb5 bold fs12">
							<a href="/parties/talk_topic?id=<?=$id?>"><?=htmlspecialchars($topic['topic'])?></a>
						</div>
						<div class="fs11 pb5">
							<div class="left quiet">
								<?=t('Всего сообщений')?>:
								<b><?=$topic['messages_count']?></b>,
								<?=t('Последнее')?>:
								<a href="/parties/talk_topic?id=<?=$id?>&last=1"><?=date_helper::human($topic['updated_ts'], ', ')?> &rarr;</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				<? } ?>
			<? } ?>
			</div>
	
			<div id="pane_program" class="content_pane hidden">
			<div class="box_content p5 mb10 fs11"><a href="/parties/program?id=<?=$party['id']?>"><?=t('Полная версия программы')?> &rarr;</a></div>
				<? if ( $program ) { ?>
					<div class="fs12">
						<? foreach ( $program as $id ) { ?>
							<? $program = parties_program_peer::instance()->get_item($id) ?>
							<div class="box_content p5">
								<div class="bold left"><?=htmlspecialchars(ideas_peer::get_segment_name($program['segment']))?></div>
								<div class="right fs11" id="program_rate_<?=$id?>">
									<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
										<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, true);"><?=tag_helper::image('common/up.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
									<? } ?>
									<span id="program_for_<?=$id?>" class="mr10" style="color: green"><?=(int)$program['for']?></span>
	
									<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
										<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, false);"><?=tag_helper::image('common/down.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
									<? } ?>
									<span id="program_against_<?=$id?>" style="color: red"><?=(int)$program['against']?></span>
								</div>
								<div class="clear"></div>
							</div>
							<div class="fs12 p5 mb10"><?=nl2br(htmlspecialchars($program['text']))?></div>
						<? } ?>
					</div>
				<? } else { ?>
					<div class="m5 acenter fs12"><?=t('Программа еще не изложена')?></div>
				<? } ?>
			</div>
		<? } else { ?>
			<?=t('Партия в процессе проверки')?>
		<? } ?>
	</div>
	<div class="clear"></div><br />
</div>
