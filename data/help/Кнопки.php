<p><?=t('Эти кнопки можно вставить в блог, на форум или любой другой сайт.')?> 
<p>1. <?=t('Выберите вариант кнопки')?>:

<div align="center">
	<? for ( $i = 1; $i <= 8; $i++ ) echo tag_helper::image(
		'logos/brand-button-' . $i . '.png',
		array(
			'class' => 'pointer buttons',
			'style' => 'background: #FAFAFA; padding: 15px; margin: 10px;',
			'onclick' => "$('.buttons').css('background', '#FAFAFA'); $(this).css('background', '#EEE'); $('#button_code').val( $('#template_code').html().replace('#', '{$i}') );",
		)
	) ?>
</div>

<br />
<p>2. <?=t('HTML код (скопируйте и вставьте на сайт)')?>:

<div style="margin: 10px 75px">
	<textarea id="button_code" style="width: 525px;"></textarea>
</div>

<div id="template_code" class="hidden"><a href="http://<?=context::get('host')?>/" title="<?=conf::get('project_name')?> - <?=t('политическая социальная сеть: Политика, власть и общество')?>"><?=tag_helper::image('logos/brand-button-#.png', array('alt' => conf::get('project_name'), 'style' => 'border:0px;'))?></a></div>
