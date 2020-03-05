<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=133922360065517";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<style type="text/css">
    .parties{
           list-style: none outside none;
    margin: 0;
    padding: 0;
    }
    .parties li{
        width:140px;
        min-height:220px;
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
    .fb-comments, .fb-comments iframe[style] {width: 650px !important;}
    .fb_ltr {width: 650px !important;}
    
</style>
<div class="left" style="width: 70%;">
	<h1><?=t('Выборы Президента Украины') ?> 2014</h1>
        <div class="mt5 mb15">
                <a class="mr10 fs18 <?=request::get('sort') ? '' : ' black'?>" href="/vyborypresidenta2014"><?=t('вперемешку')?></a>
                <a class="mr10 fs18 <?=request::get('sort')=='votes' ? ' black' : ''?>" href="/vyborypresidenta2014?sort=votes"><?=t('по голосам')?></a>
                <a class="mr10 fs18 <?=request::get('sort')=='abc' ? ' black' : ''?>" href="/vyborypresidenta2014?sort=abc"><?=t('по алфавиту')?></a>
                <a class="fs18 <?=request::get('sort')=='rating' ? ' black' : ''?>" href="/vyborypresidenta2014?sort=rating"><?=t('по рейтингу')?></a>
	</div>
	<div class="clear mb5">&nbsp;</div>
	<ul class="parties mt10">
		<?
                
                foreach ( $list as $id ) {
			$user_data=user_data_peer::instance()->get_item($id); ?>
			<li id="party<?=$id?>">
                            <div style="min-height:20px;">
                            <a class="fs12" target="_blank" href="/profile-<?=$id?>"><?=htmlspecialchars($user_data['first_name'])?> <?=htmlspecialchars($user_data['last_name'])?></a>
                            </div>
				<?=user_helper::photo($id, 't', array('class'=>'mt5'))?><br/>
					<span style="color:green;font-weight: bold;font-size: 24px;"><?=votes2014_peer::get_by_user($id)?></span><br/>
                                        <span style="color:gray;font-weight: bold;font-size: 11px;"><?=t('Голосов')?></span><br/>
                                        <button onclick="vybory2014Controller.vote('<?=$user_data['user_id']?>')"><?=t('Голосовать')?></button>
			</li>
		<? } ?>
	</ul>
	<div class="clear"></div><br />
<div class="fb-comments" data-href="https://politiko.ua/vyborypresidenta2014" data-width="650" data-numposts="15" data-colorscheme="light"></div>
</div>

<div class="right" style="width: 28%;">
    <div class="m10"><script type="text/javascript">GA_googleFillSlot("Politiko_<?=$banner_cat?>_right_300x250");</script></div>
    <div class="m10"><script type="text/javascript">GA_googleFillSlot("politiko_all_right_300x1000");</script></div>
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
