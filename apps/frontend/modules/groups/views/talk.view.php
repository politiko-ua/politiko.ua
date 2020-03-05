<h1 class="mt10 mr10 column_head">
	<a href="/group<?=$group['id']?>"><?=htmlspecialchars($group['title'])?></a> &rarr <?=t('Обсуждения')?>
</h1>

<? if ( session::is_authenticated() ) { ?>
	<form class="form_bg mr10 fs12 p10 mb10" action="/groups/talk_create?id=<?=$group['id']?>" id="topic_form">
		<div class="left">
			<a class="filter <?=!$filter ? ' filter_selected' : ''?>" href="talk?id=<?=$group['id']?>"><?=t('Новые Темы')?></a>
			<a class="filter <?=$filter == 'hot' ? ' filter_selected' : ''?>" href="talk?id=<?=$group['id']?>&filter=hot"><?=t('Самые обсуждаемые')?></a>
		</div>
		<a href="javascript:;" onclick="$('#create_topic').show(50);" class="mt5 right dotted"><?=t('Создать тему')?></a>
		<div class="clear"></div>
		<div class="hidden" id="create_topic">
			<input type="hidden" name="id" value="<?=$group['id']?>">
			<table width="100%" class="mt10">
				<tr>
					<td width="18%" class="aright"><?=t('Название')?></td>
					<td><input type="text" class="text" style="width: 500px;" name="topic" rel="<?=t('Введите название темы')?>" /></td>
				</tr>
				<tr>
					<td width="18%" class="aright"><?=t('Текст')?></td>
					<td><textarea style="width: 500px; height: 50px;" name="text" rel="<?=t('Введите текст')?>"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input name="submit" type="submit" value=" <?=t('Создать')?> " class="button">
						<input type="button" class="button_gray" value=" <?=t('Отмена')?> " onclick="$('#create_topic').hide();" />
						<?=tag_helper::wait_panel()?>
					</td>
				</tr>
			</table>
		</div>
	</form>
<? } else { ?>
	<div class="mr10"><?=user_helper::login_require( t('Войдите в систему, что-бы вести обсуждения') )?></div><br />
<? } ?>

<? if ( $list ) { ?>
	<? foreach ( $list as $id ) { include 'partials/topic.php'; } ?>
	<div class="bottom_line_d mb10 mr10"></div>
	<div class="right pager mr10"><?=pager_helper::get_full($pager)?></div>
<? } else { ?>
	<div id="no_questions" class="acenter fs12 p5 ml10">
		<?=t('Обсуждения еще не велись')?>
	</div>
<? } ?>