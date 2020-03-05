<? include 'partials/sub_menu.php' ?>

<div class="form_bg">

	<h1 class="column_head"><?= t('Поднять запись') ?></h1>

	<form class="form p10" method="post" action="https://bank.smscoin.com/bank/">

		<p class="quiet">
			<?=t('Продвижение передвинет выбранный пост на первую страницу эфира.')?>
			<?=t('После поднятия поста, он будет вытесняться только более новыми записями в ленте.')?>
		</p>

		<p align=center><a title="Нажмите для увеличения" href="javascript:;" onclick="$(this).children().attr('height', 450)"><?=tag_helper::image('help/promote.png', array('height' => '250'))?></a></p>

		<p class="quiet fs11">
			<?=t('Услуга платная и оплачивается через СМС (провайдер smscoin.ru).
				Стоимость услуги - <b>8 грн<b/>.')?>
			<?=t('После оплаты, выполняется проверка, поэтому есть незначительное время задержки поднятия поста (от нескольких минут до нескольких часов).')?>
		</p>

		<input name="post_id" type="hidden" value="<?=$post_data['id']?>" />
		<input name="s_purse" type="hidden" value="<?=$bank_id?>" />
		<input name="s_order_id" type="hidden" value="<?=$order?>" />
		<input name="s_amount" type="hidden" value="<?=$amount?>" />
		<input name="s_clear_amount" type="hidden" value="0" />
		<input name="s_description" type="hidden" value="<?=$description?>" />
		<input name="s_sign" type="hidden" value="<?=$sign?>" />

		<div class="acenter">
			<input type="submit" value=" <?=t('Оплатить')?> " class="button" style="font-size: 16px; padding: 5px 15px;" />
		</div>
	</form>
</div>
