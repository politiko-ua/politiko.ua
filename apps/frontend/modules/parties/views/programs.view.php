<? $sub_menu = '/parties/programs'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="left" style="width: 35%;">
	<h1 class="column_head"><?=t('Сектора')?></h1>
	<div class="p10 box_content fs12">
		<ul class="mb5">
			<? foreach ( ideas_peer::get_segments() as $id => $title ) { ?>
				<li><a style="<?= $title == $segment ? 'color: #772f23; text-decoration: none; font-weight: bold;' : ''?>" href="/parties/programs?segment=<?=urlencode($title)?>"><?=$title?></a></li>
			<? } ?>
		</ul>
	</div>
</div>

<div class="left ml10" style="width: 62%;">
	<h1 class="column_head">
		<?=$segment ? htmlspecialchars($segment) : t('Программы');?>
	</h1>

	<? if ( !$segment ) { ?>
		<div class="screen_message acenter quiet">
			<?=t('Для того, что-бы посмотреть программы партий, выберите интересующий Вас сектор в левой части страницы.')?>
		</div>
	<? } else if ( !$list ) { ?>
		<div class="screen_message acenter quiet">
			<?=t('В этом секторе ни одна партия не имеет предложений по развитию')?>
		</div>
	<? } else { ?>
		<? foreach ( $list as $program_id ) { ?>
			<div class="box_content p10 mb10 fs12">
				<? $program = parties_program_peer::instance()->get_item($program_id) ?>
				<? $party = parties_peer::instance()->get_item($program['party_id']) ?>
				<div class="left">
					<?=party_helper::photo($program['party_id'], 's', true, array('class' => 'border1'));?>
				</div>
				<div style="margin-left: 60px;">
					<a href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
					<div class="fs11 quiet mt10" id="program_rate_<?=$program_id?>">
						<?=t('Поддерживают')?>:
						<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
							<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, true);"><?=tag_helper::image('common/up.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
						<? } ?>
						<span id="program_for_<?=$program_id?>" class="mr10" style="color: green"><?=(int)$program['for']?></span>

						<?=t('Против')?>:
						<? if ( session::is_authenticated() && !parties_program_peer::instance()->has_rated($program['id'], session::get_user_id()) ) { ?>
							<a href="javascript:;" onclick="partiesController.rateProgram(<?=$program['id']?>, false);"><?=tag_helper::image('common/down.gif', array('height' => 16, 'class' => 'vcenter'))?></a>
						<? } ?>
						<span id="program_against_<?=$program_id?>" style="color: red"><?=(int)$program['against']?></span>
					</div>
				</div>
				<div class="clear"></div>
				<?=htmlspecialchars($program['text']);?>
				<div class="mt5">
					<a class="fs11" href="/parties/program?id=<?=$party['id']?>"><?=t('Вся программа')?> &rarr;</a>
				</div>
			</div>
		<? } ?>

		<div class="bottom_line_d mb10"></div>
		<div class="right pager"><?=pager_helper::get_full($pager)?></div>
	<? } ?>

</div>