<? load::view_helper('party');
load::view_helper('group'); ?>

<?php $sub_menu = '/blogs/news'; ?>
<? include 'partials/sub_menu.php' ?>

<div class="left" style="width: 35%;"><? include 'partials/left.php' ?></div>

<div class="left ml10" style="width: 62%;">

    <div class="column_head">
        <h1>
            <a href="/blogs/news"> <?= t('Новости') ?></a>
            &rarr;
            <?= t('Партии и группы') ?>
        </h1>
    </div>

    <?php foreach ($list as $data) { ?>
        <div class="left mr10 acenter" style="width: 70px;">
            <? if ($data['group_id']) { ?>
                <?= group_helper::photo($data['group_id'], 's', true, ['class' => 'mt5 border1']); ?>
            <? } else { ?>
                <?= party_helper::photo($data['party_id'], 's', true, ['class' => 'mt5 border1']); ?>
            <? } ?>
            <div class="quiet fs10 mb10 acenter"><?= date_helper::human($data['created_ts']) ?></div>
        </div>
        <div style="margin-left: 80px;">
            <h5 class="mb5">
                <? if ($data['group_id']) { ?>
                    <?= t('Группа') ?>
                    <?= group_helper::title($data['group_id']); ?>
                <? } else { ?>
                    <?= t('Партия') ?>
                    <?= party_helper::title($data['party_id']); ?>
                <? } ?>
            </h5>
            <div class="fs12">
                <div class="mb10"><?= text_helper::smart_trim($data['text'], 256) ?></div>
                <div class="p5" style="background: #F7F7F7;">
                    <a style="margin-right: 25px;"
                       href="<?= $data['group_id'] ? '/groups/newsread?id='.$data['id'] : '/parties/newsread?id='.$data['id'] ?>"
                       class="fs11"><?= t('Читать дальше') ?> &rarr;</a>
                </div>
            </div>
        </div>
        <div class="clear mb5"></div>
    <?php } ?>

    <div class="bottom_line_d mb10"></div>
    <div class="right pager"><?= pager_helper::get_short($pager) ?></div>

</div>
