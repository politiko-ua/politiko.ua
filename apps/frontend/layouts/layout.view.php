<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//RU" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">
<head>
	<?=client_helper::get_title()?>
	<?=client_helper::get_meta()?>
	<?=tag_helper::css('system.css') ?>
	<?=tag_helper::rss();?>
	<link REL="SHORTCUT ICON" HREF="/favico.ico">
	<meta property="fb:pages" content="131785160227053" />
	<? include '_banner.init.php'; ?>
</head>

<body style="background: #EFF3FA;">

<div>
	<div class="head_pane">
		<div class="root_container">
			<div class="left" style="width: 170px;">
				<a href="https://<?=context::get('server')?>/"><?=tag_helper::image('logo.png', array('class' => 'mt10 mb5'))?></a>
			</div>
			<div class="left mt10">
				<div class="left public_menu"><? include '_menu.php'; ?></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

<div style="padding: 20px 0; background:#fff;">
<div id='div-gpt-ad-1394037368423-0' style='width:728px; height:90px;margin: 0px auto;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1394037368423-0'); });
</script>
</div></div>

	<div style="background: #FFF;">
		<div class="root_container container_bg">
			<div class="left" style="width:690px">
				<? include $controller->get_template_path() ?>
			</div>
			<div class="left" style="width: 310px;">

				<? $controller->get_slot_path('top.context') ? include $controller->get_slot_path('top.context') : ''; ?>

				<div class="m10"><script type="text/javascript">GA_googleFillSlot("Politiko_<?=$banner_cat?>_right_300x250");</script></div>

				<? $controller->get_slot_path('context') ? include $controller->get_slot_path('context') : ''; ?>

				<div class="box_content p10 ml10 mt10">

                                        <!-- FB Widget -->
                                        <div id="fb-root"></div>

                                        <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=45439413586";
                                        fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                        </script>
                                        <div class="fb-like-box"
                                            data-href="https://www.facebook.com/politiko.ua" 
                                            data-width="250" data-show-faces="true" data-stream="false" data-header="true"></div>
                                        <!-- //FB Widget -->
					<div class=clear></div>
										<!-- //Google Widget -->
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<ins class="adsbygoogle"
										style="display:block"
										data-ad-format="autorelaxed"
										data-ad-client="ca-pub-2724022320030657"
										data-ad-slot="9701533082"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
										<!-- //Google Widget -->
				</div>

			</div>

			<div class="clear"></div>
			<br />
		</div>
	</div>

	<div class="clear"></div>
	<div style="padding: 20px 0; background:#fff;">

<div id='div-gpt-ad-1394198107100-0' style='width:728px; height:90px;margin:0 auto;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1394198107100-0'); });
</script>
</div>

</div>
</div>

<div class="top_line_2 fs11">
	<div class="root_container mt10 footer"><? include dirname(__FILE__) . '/_footer.php' ?><br />&nbsp;</div>
</div>

<? if ( !conf::get('enable_web_debug') ) { include '_counter.php'; } ?>

</body>

<?=tag_helper::js('system.js') ?>
<?=tag_helper::js('module_' . context::get_controller()->get_module() . '.js' ) ?>

<? if ( conf::get('javascript_debug') || session::get_user_id()==125588  || $_SERVER['REMOTE_ADDR']=='109.201.241.15') { ?>
    <?=tag_helper::js('debug.js') ?>
<? } ?>

<? include dirname(__FILE__) . '/_js_static.php' ?>

</html>
<!-- Executed in: <?=microtime(true) - APP_START_TS?> !-->
