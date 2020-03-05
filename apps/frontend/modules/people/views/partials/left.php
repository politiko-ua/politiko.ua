<h1 class="column_head mt10"><?=t('Роль')?></h1>
<div class="p10 box_content">
	<ul class="mb5">
		<? foreach ( user_auth_peer::get_types() as $type => $title ) { ?>
		<li><a href="/people/index?type=<?=$type?>" style="<?= $type==$cur_type ? 'color: #772f23; font-weight: bold; text-decoration: none;' : ''?>; margin: 1px;"><?=$title?></a></li>
	<? } ?>
	</ul>
</div>

<br />
<h1 class="column_head mt10"><?=t('Взгляды')?></h1>
<div id="direction_graph" class="acenter m10 fs11 quiet"><?=t('Секунду, график грузится')?>...</div>