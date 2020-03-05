	<? //$rating = candidates_votes_peer::instance()->get_rating(); ?>
                          
        <div class="aright" style="float:right;"><a onclick="vybory2012Controller.popup_hide()" href="javascript:;">x</a>&nbsp;</div><div class="head_pane aleft p5"><?=t('Мой выбор')?>:</div>
	<div class="left">
		<?=party_helper::photo($id, 'm');?>
	</div>
	<div class="fs18 left mt15 aleft p10" style="max-width:200px">
                <?=$party['title']?>
	</div>
        <div class="clear"></div>
        
	<div>
            <?=t('Выберите способ голосования')?>:<br/>
             <a target="blank_" onclick="vybory2012Controller.hide()" href="/vybory2012/facebook?id=<?=$id?>" class="vote_social"><img border="0" align="absmiddle" title="Facebook" src="https://nbnews.com.ua/img/vote_fb.png"></a>&nbsp;
             <a target="blank_" onclick="vybory2012Controller.hide()" href="https://oauth.vk.com/authorize?client_id=2953461&redirect_uri=https://<?=context::get('server')?>/vybory2012/vk%3Fid=<?=$id?>&display=page" class="vote_social"><img border="0" align="absmiddle" title="В контакте" src="https://nbnews.com.ua/img/vote_vk.png"></a>&nbsp;
             <a onclick="vybory2012Controller.politiko_vote(<?=$id?>)" href="#" class="vote_social"><img border="0" align="absmiddle" title="Politiko.ua" src="https://s1.politiko.ua/icons/politiko.png"></a>&nbsp;
        </div>
        <div class="success mr10 mt10 hidden"><?=t('Спасибо! Ваш голос будет учтен')?></div>   