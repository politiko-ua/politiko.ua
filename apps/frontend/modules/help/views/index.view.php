<h1 class="column_head mt10 mr10"><?=t( str_replace('_', ' ', $document) )?></h1>

<? if ( session::has_credential('admin') ) { ?>
	<a href="javascript:;" class="fs11" onclick="$('#edit_form').toggle();"><?=t('Редактировать страницу')?></a>

	<form class="form hidden" id="edit_form" method="post">
		<textarea name="body" style="height:550px;width: 675px;"><?=htmlspecialchars($html)?></textarea>

<script src="/static/javascript/library/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
// O2k7 skin
tinyMCE.init({
	mode : "exact",
	language : '<?=translate::get_lang() == 'ru' ? 'ru' : 'uk'?>',
	elements : "body",
	theme : "advanced",
	skin : "o2k7",
	plugins : "insertdatetime,contextmenu,paste,directionality,visualchars,xhtmlxtras,table,media,youtube",

	theme_advanced_buttons1 : "bold,italic,underline,blockquote,|,forecolor,|,bullist,numlist,|,link,image,youtube,|,tablecontrols",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",

	content_css: '/static/css/typography.css'
});
</script>

	<br />
	<input type="submit" class="button" value="Сохранить" />

	</form>
<? } ?>

<div class="mt10 mr10"><?= $html ?></div>
<br />