<div class="left">
	<h1>Выбор партий на <?=t('Выборы') ?> 2012</h1>
        <form method="post" action="">
        <? foreach ( $list as $id ) {
                $party=db::get_row('SELECT * FROM parties WHERE id='.$id); ?>
                <input type="checkbox" name="party[]" value="<?=$id?>" <?=$party['vybory_2012'] ? 'checked' : ''?> />
                <input type="text" name="title[<?=$party['id']?>]" value="<?=htmlspecialchars($party['title'])?>" size="75" />
                <br/>
        <? } ?>
                <input type="submit" name="submit" value="<?=t('Сохранить')?>"/>
	</form>
	<div class="clear"></div><br />

</div>


<div class="clear"></div>
<br/>
