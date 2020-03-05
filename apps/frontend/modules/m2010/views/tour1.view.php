<div class="left" style="width: 60%;">
	<h1><?=t('Результаты первого тура выборов')?></h1>

	<? /*<div id="dynamics" style="z-index: 0" class="acenter m10 fs11 quiet"><?=t('Секунду')?>...</div>*/ ?>

	<ol class="candidates_results">
                <? foreach ( $rating as $line ) { ?>
                        <li>
                                <? if ( $line['id'] ) { ?>
                                        <?=user_helper::photo($line['id'], 't')?>
                                <? } else { ?>
                                        <?=tag_helper::image('common/none.png', array('width' => 75))?>
                                <? } ?>

				<? $percent = $line['votes'] ?>
                                <div class="details">
                                        <? if ( $line['id'] ) { ?>
                                                <?=user_helper::full_name($line['id'])?>
                                        <? } else { ?>
                                                <?=t('Против всех')?>
                                        <? } ?>

                                        <b class="ml10"><?=$percent?>%</b>

                                        <div class="clear"></div>
                                        <div class="candidate_progress" style="width: <?=( $percent > 0 ? $percent : 1 )*4.5?>px"></div>
                                </div>

                                <div class="clear"></div>

                        </li>
                <? } ?>
        </ol>
</div>

<div class="right" style="width: 35%;">

	<h1><a href="/"><?=t('Выборы 2010')?></a></h1>

	<h1><a href="https://<?=context::get('server')?>/blogs/index?tag=<?=$tag?>"><?=t('Новости')?></a></h1>
	<div>
		<? if ( $news ) foreach ( $news as $id ) { ?>
			<? $post_data = blogs_posts_peer::instance()->get_item($id) ?>
				<div style="background:#F7F7F7;" class="p5 mb10">
					<div class="left fs11" style="margin-top: 3px;"><?=date('H:i', $post_data['created_ts'])?></div>
					<div class="left ml10" style="width: 280px;">
						<a class="<?=$post_data['rate'] > 5 ? 'bold' : ''?> fs12" href="https://<?=context::get('server')?>/blogpost<?=$id?>"><?=htmlspecialchars($post_data['title'])?></a>
						<div class="fs11"><?=user_helper::full_name($post_data['user_id'], true, array('class' => 'quiet'))?></div>
					</div>
					<div class="clear"></div>
				</div>
		<? } ?>
	</div>

</div>

<div class="clear"></div>
<br/>
