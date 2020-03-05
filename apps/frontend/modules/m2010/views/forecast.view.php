<div class="left" style="width: 60%;">
	<h1><?=t('Прогноз результатов выборов') ?></h1>

	<div class="box_content p10 mb10">
		<div class="left mr10"><?=user_helper::photo($winner_id)?></div>
		<div>
			<?=t('Наиболее точный прогноз сделал: ')?>
			<b><?=user_helper::full_name($winner_id)?></b>
			<br /><br />
			<?=t('Его прогноз')?>:
			<ol>
				<? foreach ( $winner_forecast as $data ) { ?>
					<li><?=user_helper::full_name($data['candidate_id'])?>, <?=$data['votes']?>%</li>
				<? } ?>
			</ol>

			<?=t('Сумарная ошибка')?>: <?=$winner_error?>%
		</div>
		<div class="clear"></div>
	</div>

	<? /*
	<? if ( time() > $forecast_end ) { ?>
		<?=t('Прием прогнозов остановлен')?>
	<? } else { ?>
		<div class="box_content p10 mb10">
			<?=t('Оставьте Ваш прогноз победителей первого тура выборов президента Украины 2010.')?>
			<b><?=t('За самый точный прогноз - приз и грамота "Самый меткий эксперт"')?>!</b>
			<br />
			<span class="fs11">
				<?=t('Выберите кандидатов на соответствующих позициях и укажите процентный показатель набранных ими голосов. Вы можете изменить свой прогноз до')?>
				<?=date('H:i d.m.Y', $forecast_end)?>.
			</span>
		</div>

		<div class="success hidden"><?=t('Спасибо! Ваш прогноз принят')?></div>
		<div class="error hidden"><?=t('Укажите все пять мест и набранные голоса')?></div>

		<form onsubmit="m2010Controller.forecast( this ); return false;" class="acenter">
			<ol>
				<? for ( $i = 0; $i < 5; $i ++ ) { ?>
				<li>
					<select name="candidate[<?=$i+1?>]">
						<option value=""><?=t('Выберите')?>...</option>
						<option value="0" <?=is_numeric($my_forecast[$i]['candidate_id']) && ( $my_forecast[$i]['candidate_id'] == 0 ) ? 'SELECTED' : ''?>><?=t('Против всех')?></option>
						<? foreach ( $list as $candidate_id ) { ?>
							<option <?=$my_forecast[$i]['candidate_id'] == $candidate_id ? 'SELECTED' : ''?> value="<?=$candidate_id?>"><?=user_helper::full_name($candidate_id, false)?></option>
						<? } ?>
					</select>

					<input class="text" type="text" name="vote[<?=$i+1?>]" value="<?=$my_forecast[$i]['votes']?>"> %
				</li>
				<? } ?>
			</ol>

			<div class="acenter">
				<? if ( session::is_authenticated() ) { ?>
					<input type="submit" class="button" value="<?=t('Сделать прогноз')?>">
				<? } else { ?>
					<a href="https://<?=context::get('server')?>/"><?=t('Войти на сайт');?></a> <?=t('либо');?> <a href="https://<?=context::get('server')?>/sign/up"><?=t('зарегистрироваться');?></a>
				<? } ?>
			</div>

		</form>
	<? } ?> */ ?>

</div>

<div class="right acenter" style="width: 35%;">

	<h1><a href="/"><?=t('Выборы 2010')?></a></h1>

	<? if ( time() < $forecast_end ) { ?>
		<h3><?=t('Дней до выборов')?>:</h3>
		<br />
		<div class="acenter" style="font-size: 36px;">
			<?=(int)date('d', $forecast_end - time())?>
		</div>
	<? } ?>
</div>

<div class="clear"></div><br/>
