<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Административная панель')?></h1>

	<div id="user_stats" style="z-index: 0" class="acenter m10 fs11 quiet"><?=t('Секунду, график грузится')?>...</div>

	<table class="fs12">
		<? foreach ( $stats as $name => $value ) { ?>
			<tr>
				<td class="aright" width="50%"><?=$name?></td>
				<td>
					<?=$value?>
					<? if ( !empty($subStats[$name]) ) { ?>
						<a href="/admin/newparties">+<?=$subStats[$name] ?></a>
					<? } ?>
				</td>
			</tr>
		<? } ?>
	</table>

</div>