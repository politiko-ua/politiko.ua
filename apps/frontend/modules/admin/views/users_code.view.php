<div class="left mt10" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10 mt10" style="width: 62%;">
	<h1 class="column_head"><?=t('Новый код приглашения')?></h1>

	<div class="box_content acenter p10 fs12" style="font-size: 24px;">
		<?=user_auth_peer::instance()->code_create();?>
	</div>
</div>
