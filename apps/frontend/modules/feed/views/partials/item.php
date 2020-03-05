<? $item = feed_peer::instance()->get_item($id) ?>
<? $item['text'] = str_replace('[[action]]', feed_peer::get_action($item['action']), $item['text']) ?>
<div id="feed_item_<?=$id?>" class="mb10 mr10 box_content p10 fs12">
	<div class="left" style="width: 90%;"><?=$item['text']?></div>
	<a class="delete right" href="javascript:;" onclick="feedController.deleteItem(<?=$id?>);"></a>
	<div class="clear"></div>
</div>