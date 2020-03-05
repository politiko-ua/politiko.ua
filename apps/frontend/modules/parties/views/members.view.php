<h1 class="column_head mt10 mr10">
	<?=t('Партия')?>
	<a href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
</h1>

<div class="mr10">
	<? if ( !$list ) { ?>
		<div class="acenter fs11 quiet m10 p10"><?=t('Тут еще никого нет')?>...</div>
	<? } else { ?>
		<? foreach ( $list as $id ) { include 'partials/person.php'; } ?>
		<div class="clear bottom_line_d mb10"></div>
		<div class="right pager"><?=pager_helper::get_full($pager)?></div>
	<? } ?>
</div>