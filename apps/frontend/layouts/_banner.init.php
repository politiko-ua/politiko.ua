<?

if ( conf::get('disable_banners') ) return;

$banner_conf = conf::get('banners');
if ( in_array(context::get_controller()->get_module(), $banner_conf['categories']) )
{
	$banner_cat = context::get_controller()->get_module();
}
else
{
	$banner_cat = $banner_conf['default'];
}
?>
<script type="text/javascript" src="https://partner.googleadservices.com/gampad/google_service.js"></script>
<script type="text/javascript">
	GS_googleAddAdSenseService("ca-pub-2724022320030657");
	GS_googleEnableAllServices();
</script>

<? if ( session::get_user_id() ) { ?>
	<script type="text/javascript">
		<? $targer_user_data = user_data_peer::instance()->get_item( session::get_user_id() ) ?>

		<? $targeting_map['political_views'] = array(
			1 => 'либерализм',
			2 => 'социализм',
			3 => 'коммунизм',
			4 => 'национализм',
			5 => 'другое',
			6 => 'неопределился'
		) ?>

		<? if ( $pv_target = $targeting_map['political_views'][$targer_user_data['political_views']] ) { ?>
			GA_googleAddAttr("<?=$pv_target?>");
		<? } ?>
	</script>
<? } ?>

<script type="text/javascript">
	GA_googleAddSlot("ca-pub-2724022320030657", "Politiko_<?=$banner_cat?>_right_300x250");
	GA_googleAddSlot("ca-pub-2724022320030657", "politiko_all_right_300x1000");

	<? if ( context::get_controller()->get_module() == 'blogs' ) { ?>
		GA_googleAddSlot("ca-pub-2724022320030657", "Politiko_blogs_down_468x60");
	<? } ?>

	GA_googleFetchAds();
</script>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/1056189/Politiko_up_728x90', [728, 90], 'div-gpt-ad-1394037368423-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
googletag.cmd.push(function() {
googletag.defineSlot('/1056189/Plitiko_down_728x90', [728, 90], 'div-gpt-ad-1394198107100-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
