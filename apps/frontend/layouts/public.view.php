<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//RU" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">
<head>
	<?=client_helper::get_title()?>
	<?=client_helper::get_meta()?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="verify-admitad" content="d4cd1876ed" />
	<link REL="SHORTCUT ICON" HREF="/favico.ico">
	<meta property="fb:pages" content="131785160227053" />
	<?=tag_helper::css('system.css') ?>
	<? include '_banner.init.php'; ?>
</head>

<body style="background: #EFF3FA;">

<div>
	<div class="head_pane">
		<div class="root_container">
			<div class="left" style="width: 170px;">
				<a href="https://<?=context::get('server')?>/"><?=tag_helper::image('logo.png', array('class' => 'mt10 mb5'))?></a>
			</div>
			<div class="left mt10"><div class="left public_menu"><? include '_menu.php'; ?></div></div>
			<div class="clear"></div>
		</div>
	</div>

	<div style="background: #FFF;">
		<div class="root_container"><div class="pt5"><? include $controller->get_template_path() ?></div></div>


		<div style="padding: 20px 0;">
<div id='div-gpt-ad-1394037368423-0' style='width:728px; height:90px;margin: 0px auto;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1394037368423-0'); });
</script>
</div>
</div>
	</div>

	<div class="clear"></div>
</div>

<div class="top_line_2 fs11">
	<div class="root_container mt10"><? include dirname(__FILE__) . '/_footer.php' ?><br />&nbsp;</div>
</div>

<? include '_counter.php' ?>

</body>

<?=tag_helper::js('system.js') ?>
<?=tag_helper::js('module_' . context::get_controller()->get_module() . '.js' ) ?>

<? if ( conf::get('javascript_debug')  || $_SERVER['REMOTE_ADDR']=='109.201.241.15' ) { ?>
    <?=tag_helper::js('debug.js') ?>
<? } ?>

<? include dirname(__FILE__) . '/_js_static.php' ?>

</html>
