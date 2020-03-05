<div class="left" id="home-content" style="width: 62%;">
	<h1><?=t('Обсуждаемые лица')?></h1>
	<ul class="faces">
		<? foreach ( $mentions as $mention ) { ?>
			<li>
				<?=user_helper::photo($mention['user_id'], 'mm', null, false)?>

				<a href="/profile-<?=$mention['user_id']?>">
					<h3><?=user_helper::full_name($mention['user_id'], false)?></h3>
					<?=t('Записей')?>: <?=$mention['total']?>
				</a>
			</li>
		<? } ?>
	</ul>
	<div class="clear"></div><br />
	<h4><?=t('Частота упоминаний в блогах')?></h4>
	<br />
	
	<img src="<?=$mentions_chart?>"/>
	<br /><br />

	<h1><a href="/blogs"><?=t('Прямой эфир')?></a></h1>
	<ul class="hot">
		<? foreach ( $casted as $i => $id ) { ?>
			<? $post = blogs_posts_peer::instance()->get_item($id) ?>

			<li>
				<a <?=$i == 2 ? 'class=last' : ''?> title="<?=htmlspecialchars($post['title'])?>" href="/blogpost<?=$post['id']?>">
					<?=user_helper::full_name($post['user_id'], false)?>:
					<h3><?=text_helper::smart_trim(htmlspecialchars($post['title']), 64)?></h3>
				</a>
			</li>
		<? } ?>
	</ul>
	<div class="clear"></div><br /><br />

	<? $post = blogs_posts_peer::instance()->get_item($discussed) ?>
	<h1><a href="/blogpost<?=$post['id']?>"><?=htmlspecialchars($post['title'])?></a><sup class="top-mark"><?=t('Гарячая тема')?></sup></h1>

	<div class="top">
		<p><?=$post['preview']?></p>
		<a href="/blogpost<?=$post['id']?>" class="mr10"><?=t('Читать статью')?> &rarr;</a>
		<a href="/blogpost<?=$post['id']?>#comments"><?=t('Читать комментарии')?> (<?=blogs_comments_peer::instance()->get_count_by_post($post['id'])?>)</a>
	</div>
	<br /><br />

</div>

<div class="right" style="width: 34%;">
	<h1><?=t('Вход на сайт')?></h1>

	<form id="signin_form" action="/sign/in" method="post">
		<table class="fs11">
			<tr>
				<td>Email</td>
				<td><input type="text" class="text" name="email" rel="required:<?=t('Введите, пожалуйста')?>, email;email:<?=t('Вы ввели неправильный email')?>;" /></td>
			</tr>
			<tr>
				<td><?=t('Пароль')?></td>
				<td>
					<input type="password" class="text" name="password" rel="required:<?=t('Введите, пожалуйста, пароль')?>" />
					<input type="checkbox" checked> <?=t('Запомнить')?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<div class="mb5"><a href="/sign/recover"><?=t('Забыли пароль')?>?</a></div>
					
					<input type="submit" name="submit" class="button" value=" <?=t('Войти')?> ">
					<?=tag_helper::wait_panel() ?>
				</td>
			</tr>
		</table>
	</form>

	<br /><br />
	<h3><a href="/sign/up"><?=t('Регистрация')?></a></h3>
	<p class="fs12">
		<?=t('Еще не зарегистрированы')?>?<br />
		<?=t('Создание аккаунта займет всего несколько секунд!')?>
		<b><a href="/sign/up"><?=t('Создать аккаунт')?></a></b>
	</p>

	<div class="m10"><script type="text/javascript">GA_googleFillSlot("Politiko_<?=$banner_cat?>_right_300x250");</script></div>

	<br />
	<p style="background:#F7F7F7;" class="p5 mb10">
		<b>Politiko</b> – <?=t('первая украинская политическая социальная сеть, объединяющая политиков, экспертов, журналистов, лидеров партий и избирателей Украины в рамках одного сообщества.')?><br />
	</p>

</div>

<div class="clear"></div>
