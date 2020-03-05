<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head">Лента модераторов</h1>

	<? foreach ( $feed as $item ) { ?>
		<div class="box_content p10 mb10">
			<?=date('H:i d.m', $item['created_ts'])?>
			<?=user_helper::full_name($item['user_id'])?>

			<div class="fs10 mt10">
				<b><?=$types[$item['type']]?></b><br />
				<?=$item['text']?>
			</div>
		</div>
	<? } ?>

	<div class="box_content p10 mb10 fs11">
		<? if ( $page > 1 ) { ?>
			<a href="/admin/mfeed?page=<?=$page - 1?>">&larr; Назад</a> &nbsp; &nbsp;
		<? } ?>
			
		<a href="/admin/mfeed?page=<?=$page + 1?>">Далее &rarr;</a>
	</div>

</div>
