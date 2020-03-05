<? $sub_menu = '/blogs/edit'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="form_bg">

	<h1 class="column_head"><?= $post_data ? t('Редактирование записи') : t('Создание записи') ?></h1>

	<form id="edit_form" class="form" method="post">
		<? if ( $post_data ) { ?>
			<input type="hidden" name="id" value="<?=$post_data['id']?>" />
		<? } ?>
		<table width="100%" class="fs12">
			<tr>
				<td class="aright" width="18%"><?=t('Заголовок')?></td>
				<td><input name="title" rel="<?=t('Введите заголовок')?>" style="width:513px;" class="text" type="text" value="<?=htmlspecialchars($post_data['title'])?>" /></td>
			</tr>
			<tr>
				<td class="aright"><?=t('Метки')?></td>
				<td>
					<input name="tags" style="width:513px;" class="text" type="text" value="<?=htmlspecialchars($post_data['tags_text'])?>" />
					<div class="fs11 quiet"><?=t('Метки вводятся через запятую, например: бизнес, банки, капитализация, индексы')?></div>
				</td>
			</tr>
			<? if ( session::has_credential('admin') ) { ?>
				<tr>
					<td class="aright"><?=t('Просмотров')?></td>
					<td>
						<input name="views" style="width:513px;" class="text" type="text" value="<?=htmlspecialchars($post_data['views'])?>" />
					</td>
				</tr>
			<? } ?>
			<tr>
				<td class="aright"><?=t('Текст')?></td>
				<td><textarea rel="<?=t('Введите текст')?>" name="body" style="height:350px;"><?=htmlspecialchars($post_data['body'])?></textarea></td>
			</tr><? /*
			<tr>
				<td class="aright"><?=t('Упоминания')?></td>
				<td>
					<input id="mention" style="width:513px;" class="text" type="text" value="" />
					<div class="fs11 quiet"><?=t('Начинайте вводить имя упоминаемого в этой статье человека')?></div>
					<div style="width:513px;" class="mt5 fs11" id="mentions"></div>
				</td>
			</tr>*/ ?>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" class="button" value=" <?=t('Сохранить')?> ">
					<input onclick="history.go(-1);" type="button" name="cancel" class="button_gray" value=" <?=t('Отмена')?> ">
					<?=tag_helper::wait_panel() ?>

					<? foreach ( $blog_types as $type => $type_title ) { ?>
						<input type="radio" class="ml10" name="type" value="<?=$type?>" id="post_type_<?=$type?>"
							<?= ($post_data['type'] == $type) || ( !$post_data['type'] && $type == blogs_posts_peer::TYPE_BLOG_POST ) ? 'checked' : ''?> />
						<label class="fs11" for="post_type_<?=$type?>"><?=$type_title?></label>
					<? } ?>

					<div class="success hidden mr10 mt10"><?=t('Запись сохранена')?></div>
				</td>
			</tr>

		</table>

<script src="/static/javascript/library/tinymce/tiny_mce.js"></script>
<script type="text/javascript">

// O2k7 skin
tinyMCE.init({
	mode : "exact",
	language : '<?=translate::get_lang() == 'ru' ? 'ru' : 'uk'?>',
	elements : "body",
	theme : "advanced",
	skin : "o2k7",
        plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras, insertdatetime,contextmenu,paste,directionality,visualchars,xhtmlxtras,table,media,youtube",

	theme_advanced_buttons1 : "bold,italic,underline,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,forecolor,|,bullist,numlist,|,link,unlink,image,youtube,",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,insertdate,inserttime,preview,|,forecolor,backcolor|,visualchars,nonbreaking,template,blockquote,pagebreak,|,unlink,link,image,cleanup,help,code,",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid",
	theme_advanced_buttons4 : "styleselect,formatselect,fontselect,fontsizeselect,link",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

	content_css: '/static/css/typography.css',
        document_base_url : "https://politiko.ua/",
        remove_script_host : false,
        relative_urls : false,
        convert_urls : true,
        height: 350

});
</script>
	</form>
</div>
