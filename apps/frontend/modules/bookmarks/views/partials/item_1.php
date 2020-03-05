<? load::model('blogs/posts') ?>
<? $data = blogs_posts_peer::instance()->get_item($item['oid']) ?>
<div id="bookmark_item_<?=$item['id']?>" class="mb10 mr10 box_content p10 fs12">
	<div class="left" style="width: 90%;">
		<?=tag_helper::image('/menu/blogs.png', array('class' => 'vcenter mr5'))?>
		<a href="/blogpost<?=$item['oid']?>"><?=htmlspecialchars($data['title'])?></a>
		<div class="mt10 fs11 quiet">
			<?=user_helper::full_name($data['user_id'])?>,
			<?=date_helper::human($data['created_ts'], ', ')?>
		</div>
	</div>
	<a class="delete right" href="javascript:;" onclick="bookmarksController.deleteItem(<?=$item['id']?>);"></a>
	<div class="clear"></div>
</div>