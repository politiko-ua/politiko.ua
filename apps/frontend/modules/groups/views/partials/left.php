<h1 class="column_head"><?=t('Категория')?></h1>
<div class="p10 box_content">
	<ul class="mb5">
		<? foreach ( groups_peer::get_types() as $type => $title ) { ?>
		<li><a href="/groups/index?type=<?=$type?>" style="<?= $type==$cur_type ? 'color: #772f23; font-weight: bold; text-decoration: none;' : ''?>; margin: 1px;"><?=$title?></a></li>
	<? } ?>
	</ul>
</div><br />

<h1 class="column_head"><?=t('Территория')?></h1>
<div class="p10 box_content">
	<ul class="mb5">
		<? foreach ( groups_peer::get_teritories() as $teritory => $title ) { ?>
		<li><a href="/groups/index?teritory=<?=$teritory?>" style="<?= $teritory==$cur_teritory ? 'color: #772f23; font-weight: bold; text-decoration: none;' : ''?>; margin: 1px;"><?=$title?></a></li>
	<? } ?>
	</ul>
</div>