<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<meta property="og:image" content="https://image.<?=context::get('server')?>/m/user/<?=request::get_int('id').$candidat['photo_salt']?>.jpg"/>
        <meta property="og:url" content="https://<?=context::get('server')?>/vybory2014/candidat?id=<?=$candidat['user_id']?>"/>
        <meta property="og:title" content="<?=t('Кандидат, которого я поддерживаю')?> -  <?=$candidat['first_name']?> <?=$candidat['last_name']?>"/>
        <title><?=t('Кандидат, которого я поддерживаю')?> -  <?=$candidat['first_name']?> <?=$candidat['last_name']?></title>
        <meta property="og:description" content="Выборы Президента 2014. Проект политической социальной сети Politiko.ua. Рейтинг поддержки кандатов в Президенты Украины. Проголосуй за своего кандидата!"/>
        <meta name="description" content="Выборы Президента 2014. Проект политической социальной сети Politiko.ua. Рейтинг поддержки кандатов в Президенты Украины. Проголосуй за своего кандидата!"/>
          <meta property="og:type" content="website"/>
    <meta property="fb:app_id" content="144994795557460"/>
    <meta property="og:site_name" content="<?=context::get('server')?>"/>
</head>
<body>
		<?=user_data_helper::photo($candidat['user_id'], 'm');?>    
</body>
</html>