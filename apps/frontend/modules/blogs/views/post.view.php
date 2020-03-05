<style type="text/css">
    .block-social, .block-blog-social {
        padding: 31px 0 0;
        white-space: nowrap;
        width: 700px;
    }

    .block-blog-social {
        padding-top: 16px;
    }

    .block-social a, .block-blog-social a {
        display: inline-block;
        font-size: 0;
        vertical-align: middle;
    }

    .block-social .block-blog-social-count, .block-blog-social .block-blog-social-count {
        color: #494949;
        font-family: Arial, FreeSans, Helvetica, sans-serif;
        font-size: 11px;
        height: 18px;
        line-height: 18px;
        padding: 0 10px 0 4px;
        vertical-align: middle;
    }

    .block-social .social-item, .block-blog-social .social-item {
        display: inline-block;
        float: left;
    }

    .block-social {
        display: block;
        padding: 29px 0 26px;
    }

    .block-social-dockable {
        background: none repeat scroll 0 0 #ECECEC;
        border-radius: 3px 3px 3px 3px;
        padding: 7px 0;
        width: 76px;
    }

    .block-social-dockable .item {
        padding: 7px 0;
        position: relative;
        z-index: 1;
    }

    .block-social-dockable .item .counter {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #C8C8C8;
        color: #4C595F;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 17px;
        font-weight: normal;
        height: 30px;
        line-height: 30px;
        margin: 0 auto;
        text-align: center;
        width: 62px;
    }

    .block-social-dockable .item .counter div {
        background: url("../images/block-soc-dockable-ico-1.gif") repeat scroll 0 0 transparent;
        font-size: 1px;
        height: 10px;
        left: 33px;
        overflow: hidden;
        position: absolute;
        top: 38px;
        width: 11px;
        z-index: 1;
    }

    .block-social-dockable .button {
        padding: 8px 0 0;
        background: none;
        border: none;
    }

    .block-social-dockable .button a {
        display: block;
        font-size: 0;
        height: 18px;
        margin: 0 auto;
        width: 65px;
    }

    .block-social-dockable .button .fb {
        background: url("/static/images/icons/ico-social-buttons-100500.png") no-repeat scroll 0 0 transparent;
    }

    .block-social-dockable .button .b {
        background: url("/static/images/icons/ico-social-buttons-100500.png") no-repeat scroll 0 -18px transparent;
    }

    .block-social-dockable .button .tw {
        background: url("/static/images/icons/ico-social-buttons-100500.png") no-repeat scroll 0 -72px transparent;
        height: 20px;
    }

    .block-social-dockable .button .u {
        background: url("/static/images/icons/ico-social-buttons-100500.png") no-repeat scroll 0 -92px transparent;
    }
</style>
<div class="mt10 mr10">
    <h1 class="column_head">
        <div class="left">
            <? if ($post_data['user_id'] == session::get_user_id()) { ?>
                <a href="/blog-<?= session::get_user_id() ?>">Мой блог</a>
            <? } else { ?>
                <a href="/blogs">Блоги</a>
            <? } ?>
            &rarr; <?= t('Просмотр') ?>
        </div>
        <div class="right fs11">
            <? if ($post_data['tags_text']) { ?>
                <b class="quiet mr5"><?= t('Метки') ?></b>
                <? foreach (explode(', ', $post_data['tags_text']) as $tag) echo "<a href=\"/blogs/index?tag=" . htmlspecialchars($tag) . "\" class=\"mr10\">{$tag}</a>" ?>
            <? } ?>
        </div>
        <div class="clear"></div>
    </h1>

    <h1 class="ml5 mb5"><?= htmlspecialchars($post_data['title']) ?></h1>
</div>

<div class="ml5 fs11 quiet mb5">
    <?= date_helper::human($post_data['created_ts'], ', ') ?>
    <? if (($post_data['user_id'] == session::get_user_id()) || (session::has_credential('moderator'))) { ?>
        <a href="/blogs/edit?id=<?= $post_data['id'] ?>" class="ml10"><?= t('Редактировать') ?></a>

        <a onclick="return confirm('<?= t('Удалить эту запись?') ?>');" href="/blogs/delete?id=<?= $post_data['id'] ?>"
           class="ml10"><?= t('Удалить') ?></a>

        <? if (session::has_credential('admin')) { ?>
            <a href="/blogs/valuable?id=<?= $post_data['id'] ?>&promote=1" class="ml10"><?= t('Поднять') ?></a>
        <? } ?>
        <? if (session::has_credential('moderator')) { ?>
            <a href="/blogs/hide?id=<?= $post_data['id'] ?>"
               class="ml10"><?= $post_data['visible'] ? t('Скрыть') : t('Показать') ?></a>
            <a href="/blogs/valuable?id=<?= $post_data['id'] ?>" class="ml10"><?= t('Сделать важным') ?></a>

            <? if (!$post_data['favorite']) { ?>
                <a href="/blogs/favorite?id=<?= $post_data['id'] ?>" class="ml10"><?= t('В избранное') ?></a>
            <? } else { ?>
                <a href="/blogs/favorite?id=<?= $post_data['id'] ?>" class="ml10"><?= t('Убрать из избранного') ?></a>
            <? } ?>
        <? } ?>
    <? } ?>
</div>

<div class="mr10">
    <div class="left acenter mt5" style="width: 80px;">
        <?= user_helper::photo($post_data['user_id'], 't', array('class' => 'border1')) ?>
        <div class="fs11 mb10">
            <?= user_helper::full_name($post_data['user_id']) ?>
            <br/><br/>
            <a href="/blog-<?= $post_data['user_id'] ?>"><?= t('Блог пользователя') ?></a>
        </div>
        <br/>

        <div class="fs11 mb5 quiet"><?= t('Рейтинг') ?></div>

        <div class="mb5 acenter" id="vote_value">
            <span class="green"><?= $post_data['for'] ?></span>
            <span class="red ml5"><?= $post_data['against'] ?></span>
        </div>

        <? if (session::has_credential('moderator')) { ?>
            <a class="fs10" href="/blogs/rate_history?id=<?= $post_data['id'] ?>"><?= t('История') ?></a>
            <br/><br/>
        <? } ?>

        <? if (session::is_authenticated() && !$is_blacklisted && !blogs_posts_peer::instance()->has_rated($post_data['id'], session::get_user_id())) { ?>
            <div id="vote_pane">
                <a title="<?= t('Голосовать за') ?>" class="fs11" onclick="blogsController.vote( true );"
                   href="javascript:;"><?= tag_helper::image('common/up.gif') ?></a>
                <a title="<?= t('Голосовать против') ?>" class="fs11" onclick="blogsController.vote( false );"
                   href="#comment_form"><?= tag_helper::image('common/down.gif') ?></a>
            </div>
        <? } ?>

        <div class="fs11 mb5 quiet"><?= t('Просмотров') ?></div>
        <div class="acenter bold"><?= (int)$post_data['views'] ?></div>

        <br/>
        <div align=center><a href="/blogs/promote?id=<?= $post_data['id'] ?>"><?= t('Поднять') ?></a></div>
        <div class="block-social-dockable mt15">
            <div class="item">
                <div id="fb_soc_counter"
                     class="counter"><?= (int)db_key::i()->get('fb_soc_counter:' . $post_data['id']) ?>
                    <div></div>
                </div>
                <div class="button">
                    <a title="Опубликовать в Фейсбуке" class="fb soc_share_a" id="fb_soc"
                       rel="https://www.facebook.com/sharer.php?u=<?= urlencode('https://politiko.ua/' . $_SERVER['REQUEST_URI']) ?>"
                       href="javascript:;"></a>
                </div>
            </div>
            <div class="item">
                    <div id="twitter_soc_counter"
                         class="counter"><?= (int)db_key::i()->get('twitter_soc_counter:' . $post_data['id']) ?>
                        <div></div>
                    </div>
                    <div class="button">
                        <a title="Опубликовать в Твиттере" class="tw soc_share_a" id="twitter_soc"
                           rel="https://twitter.com/home?status=+<?= urlencode('https://politiko.ua/' . $_SERVER['REQUEST_URI']) ?>"
                           href="javascript:;"></a>
                    </div>
                </div>
                <div class="item">
                    <div id="___plusone_0"
                         style="height: 60px; width: 50px; display: inline-block; text-indent: 0pt; margin: 0pt; padding: 0pt; background: none repeat scroll 0% 0% transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline;">
                        <iframe width="100%" scrolling="no" frameborder="0" title="+1" vspace="0" tabindex="-1"
                                style="position: static; left: 0pt; top: 0pt; width: 50px; margin: 0px; border-style: none; visibility: visible; height: 60px;"
                                src="https://plusone.google.com/_/+1/fastbutton?url=<?= urlencode('https://politiko.ua/' . $_SERVER['REQUEST_URI']) ?>&amp;size=tall&amp;count=true&amp;hl=en-US&amp;jsh=m%3B%2F_%2Fapps-static%2F_%2Fjs%2Fgapi%2F__features__%2Frt%3Dj%2Fver%3DFLUbKbHpzgo.uk.%2Fsv%3D1%2Fam%3D!mAdgFnmJxQOIii6qTQ%2Fd%3D1%2F#id=I1_1331043067721&amp;parent=http%3A%2F%2Fpolitiko.ua&amp;rpctoken=120961116&amp;_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart"
                                name="I1_1331043067721" marginwidth="0" marginheight="0" id="I1_1331043067721"
                                hspace="0" allowtransparency="true"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="left ml10 mt5" style="width: 590px;">

            <? if ($mentioned) { ?>
                <div class="ml10 box_content right fs11" style="width: 200px;">
                    <h6 class="column_head_small"><?= t('В этой статье упоминаются') ?></h6>
                    <div class="ml10 mr10 mb10">
                        <? foreach ($mentioned as $user_id) { ?>
                            <? $user = user_auth_peer::instance()->get_item($user_id) ?>
                            <?= user_helper::photo($user_id, 's', array('class' => 'left')) ?>
                            <div style="margin-left: 60px;">
                                <?= user_helper::full_name($user_id) ?>
                                <div class="mt10 quiet"><?= user_auth_peer::get_type($user['type']) ?></div>
                            </div>
                            <div class="clear mb10"></div>
                        <? } ?>
                    </div>
                </div>
            <? } ?>

            <?= $post_data['text_rendered'] ?>

            <div style="border-top: 1px solid #EEE;">
                <div class="left mt5">

                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a href="https://www.addthis.com/bookmark.php?v=250&amp;username=xa-4ce58ce120b14597"
                           class="addthis_button_compact">Share</a>
                        <span class="addthis_separator">|</span>
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                    </div>
                    <script type="text/javascript"
                            src="https://s7.addthis.com/js/250/addthis_widget.js#username=xa-4ce58ce120b14597"></script>
                    <!-- AddThis Button END -->

                </div>

                <a href="/blogs/promote?id=<?= $post_data['id'] ?>"
                   class="promote right mb10"><b></b><span><?= t('Поднять') ?></span></a>

                <? if (session::is_authenticated()) { ?>
                    <?= user_helper::share_item('blog_post', $post_data['id'], array('class' => 'mb10 right')) ?>
                    <? if (session::get_user_id() != $post_data['user_id']) { ?>
                        <?= user_helper::bookmark_item(bookmarks_peer::TYPE_BLOG_POST, $post_data['id'], array('class' => 'mb10 right')) ?>
                    <? } ?>
                <? } ?>
                <div class="clear"></div>
            </div>

            <div class="acenter p10">
                <!-- Politiko.UA -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-2724022320030657"
                     data-ad-slot="6887667483"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

            </div>

            <h3 class="column_head"><?= tag_helper::image('common/comments.png', array('class' => 'vcenter')) ?> <?= t('Комментарии') ?></h3>
            <div class="mt10 mb10" id="comments">
                <? if (!$comments) { ?>
                    <div id="no_comments" class="acenter fs11 quiet"><?= t('Нет комментариев') ?></div>
                <? } else { ?>
                    <? foreach ($comments as $id) {
                        include 'partials/comment.php';
                    } ?>
                <? } ?>
            </div>
            <? if (session::is_authenticated()) { ?>
                <? if (!$is_blacklisted) { ?>
                    <form class="form_bg" id="comment_form" action="/blogs/comment">
                        <h3 class="column_head_small mb5 ml5"
                            id="comment_add_header"><?= t('Добавить комментарий') ?></h3>
                        <div class="ml10 mr10 mb10">
                            <input type="hidden" name="neg_msg" value="0"/>
                            <input type="hidden" name="post_id" value="<?= $post_data['id'] ?>"/>
                            <textarea rel="<?= t('Напишите текст') ?>" style="width: 99%; height: 75px;"
                                      name="text"></textarea>
                            <input type="submit" name="submit" class="mt5 mb5 button left"
                                   value=" <?= t('Отправить') ?> "/>
                            <input type="button" name="cancel_v" class="mt5 ml5 mb5 left button_gray hide"
                                   value=" <?= t('Отмена') ?> "/>
                            <?= tag_helper::wait_panel() ?>
                        </div>
                    </form>

                    <form id="comment_reply_form" class="hidden" action="/blogs/comment">
                        <input type="hidden" name="post_id" value="<?= $post_data['id'] ?>"/>
                        <input type="hidden" name="parent_id"/>
                        <textarea rel="<?= t('Напишите текст') ?>" style="width: 99%; height: 50px;"
                                  name="text"></textarea>
                        <input type="submit" name="submit" class="mt5 mb5 button" value=" <?= t('Отправить') ?> "/>
                        <?= tag_helper::wait_panel() ?>
                        <input type="button" class="button_gray" value="<?= t('Отмена') ?>"
                               onclick="$('#comment_reply_form').hide();">
                    </form>
                <? } ?>
            <? } ?>

            <div class="fb-comments" data-href="https://politiko.ua/blogpost<?= $post_data['id'] ?>" data-width="600"
                 data-numposts="5" data-colorscheme="light"></div>
        </div>
    </div>

