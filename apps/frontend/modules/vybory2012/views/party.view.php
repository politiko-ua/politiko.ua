<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<meta property="og:image" content="https://image.<?=context::get('server')?>/m/party/<?=request::get_int('id').$party['photo_salt']?>.jpg"/>
        <meta property="og:url" content="https://<?=context::get('server')?>/vybory2012/party?id=<?=$party['id']?>"/>
        <meta property="og:title" content="<?=t('Партия, которую я поддерживаю')?> -  <?=$party['title']?>"/>
        <title><?=t('Партия, которую я поддерживаю')?> -  <?=$party['title']?></title>
        <meta property="og:description" content="Выборы 2012. Проект политической социальной сети Politiko.ua. Рейтинг поддержки политических партий и их возможность попасть в парламент. Проголосуй за свою партию!"/>
        <meta name="description" content="Выборы 2012. Проект политической социальной сети Politiko.ua. Рейтинг поддержки политических партий и их возможность попасть в парламент. Проголосуй за свою партию!"/>
          <meta property="og:type" content="website"/>
    <meta property="fb:app_id" content="144994795557460"/>
    <meta property="og:site_name" content="<?=context::get('server')?>"/>
</head>
<body>
		<?=party_helper::photo($party['id'], 'm',false);?>    
</body>
</html>