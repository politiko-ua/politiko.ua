<h1 class="column_head mt10 mr10">
	<a href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
	&rarr;
	<?=t('Программа')?>
</h1>

<div class="mr10">

	<? if ( !$list ) { ?>
		<div class="screen_message acenter"><?=t('Программа еще не изложена')?></div>
	<? } ?>

	<? foreach ( $list as $id ) { ?>
		<? $program = parties_program_peer::instance()->get_item($id) ?>
		<div class="box_content p5">
			<div class="bold left"><?=htmlspecialchars(ideas_peer::get_segment_name($program['segment']))?></div>
			<div class="right quiet fs11" id="program_rate_<?=$id?>">
				<?=t('Поддерживают')?>:
				<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
					<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, true);"><?=tag_helper::image('common/up.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
				<? } ?>
				<span id="program_for_<?=$id?>" class="mr10" style="color: green"><?=(int)$program['for']?></span>

				<?=t('Против')?>:
				<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
					<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, false);"><?=tag_helper::image('common/down.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
				<? } ?>
				<span id="program_against_<?=$id?>" style="color: red"><?=(int)$program['against']?></span>
			</div>
			<div class="clear"></div>
		</div>
		<div class="fs12 p5 mb10"><?=nl2br(htmlspecialchars($program['text']))?></div>
	<? } ?>

	<div class="bottom_line_d mb10"></div>
	<div class="right pager"><?=pager_helper::get_full($pager)?></div>
</div>