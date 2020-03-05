<style type="text/css">
    .parties{
           list-style: none outside none;
    margin: 0;
    padding: 0;
    }
    .parties li{
        width:140px;
        min-height:270px;
        float: left;
        text-align: center;
    }    
    
    .parties button{
        background: url("/common/button.gif") repeat scroll 0 0 #3A84C3;
        border: 1px solid #234F76;
        color: #FFFFFF;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        padding: 2px;
    }
    .black{
        font-weight: bold;
        color: black;
    }
    
</style>
<div class="left" style="width: 70%;">
	<h1><?=t('Выборы') ?> 2012</h1>
        <div class="mt5 mb15">
                <a class="mr10 fs18 <?=request::get('sort') ? '' : ' black'?>" href="/vybory2012"><?=t('вперемешку')?></a>
                <a class="mr10 fs18 <?=request::get('sort')=='votes' ? ' black' : ''?>" href="/vybory2012?sort=votes"><?=t('по голосам')?></a>
                <a class="mr10 fs18 <?=request::get('sort')=='abc' ? ' black' : ''?>" href="/vybory2012?sort=abc"><?=t('по алфавиту')?></a>
                <a class="fs18 <?=request::get('sort')=='rating' ? ' black' : ''?>" href="/vybory2012?sort=rating"><?=t('по рейтингу')?></a>
	</div>
	<div class="clear mb5">&nbsp;</div>
	<!--div class="parties">
		<? foreach ( $list as $id ) {
			$party=parties_peer::get_item($id);?>
			<div class="mb10 box_content p10">
				<div class="left"><?=party_helper::photo($party['id'], 't', true, array('class' => 'border1'))?></div>
				<div style="margin-left: 90px;">
					<a class="bold" href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>

					<? $rate_offset = ceil( $party['rate'] ) + 2 ?>
					<div class="rate mt5"><div style="background-position: <?=$rate_offset?>px 0px"><?=t('Рейтинг')?>: <?=number_format($party['rate'], 2)?></div></div>

					<div class="fs11 mt5">
						<span class="right"><?=t('Поддерживают')?>: <b><?=$party['trust']?></b></span>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<? } ?>
	</div-->
	<ul class="parties mt10">
		<? foreach ( $list as $id ) {
			$party=parties_peer::instance()->get_item($id);
                       $party['title'] = strtr($party['title'],array('Політична партія'=>''));
                       $party['title'] = strtr($party['title'],array('Партія "'=>'"'));
                       if (strpos($party['title'],'"') || $party['title'][0]=='"')
                       {
                           $name=strrchr($party['title'],'"');
                           $party['title'] = str_replace($name,'',substr($party['title'],strpos($party['title'],'"'),45));
                       }
                        //$party['title']==str_replace('Політична партія', '', $party['title'])?>
			<li id="party<?=$id?>">
                            <div style="min-height:70px;">
                            <a class="fs12" target="_blank" href="/party<?=$party['id']?>"><?=htmlspecialchars($party['title'])?></a>
                            </div>
				<?=party_helper::photo($party['id'], 't', true, array('class'=>'mt5'))?><br/>
					<span style="color:green;font-weight: bold;font-size: 24px;"><?=votes2012_peer::get_by_party($party['id'])?></span><br/>
                                        <span style="color:gray;font-weight: bold;font-size: 11px;"><?=t('Голосов')?></span><br/>
                                        <button onclick="vybory2012Controller.vote('<?=$party['id']?>')"><?=t('Голосовать')?></button>
			</li>
		<? } ?>
	</ul>
	<div class="clear"></div><br />

</div>

<div class="right" style="width: 28%;">
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
googletag.defineSlot('/1056189/vybory2012', [240, 400], 'div-gpt-ad-1338836127120-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
<div id='div-gpt-ad-1338836127120-0' style='width:240px; height:400px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1338836127120-0'); });
</script>
</div>
	<? $tag = 'Выборы'; load::model('blogs/posts'); load::model('blogs/posts_tags'); load::model('blogs/tags') ?>
	<h1><a href="https://<?=context::get('server')?>/blogs/index?tag=<?=$tag?>"><?=t('Новости')?></a></h1>
	<div>
		<? if ( $news = blogs_posts_peer::instance()->get_by_tag( blogs_tags_peer::instance()->get_by_name( $tag ) ) ) foreach ( $news as $id ) { ?>
			<? $post_data = blogs_posts_peer::instance()->get_item($id) ?>
				<div style="background:#F7F7F7;" class="p5 mb10">
					<div class="left fs11" style="margin-top: 3px;"><?=date('H:i', $post_data['created_ts'])?></div>
					<div class="left ml10" style="width: 230px;">
						<a class="<?=$post_data['rate'] > 5 ? 'bold' : ''?> fs12" href="https://<?=context::get('server')?>/blogpost<?=$id?>"><?=htmlspecialchars($post_data['title'])?></a>
						<div class="fs11"><?=user_helper::full_name($post_data['user_id'], true, array('class' => 'quiet'))?></div>
					</div>
					<div class="clear"></div>
				</div>
		<? if ($i++ >= 10) break; } ?>
	</div>

</div>

<div class="clear"></div>
<br/>
