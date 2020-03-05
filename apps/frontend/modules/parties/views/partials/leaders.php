<? if ( $leaders ) { shuffle($leaders); ?>
	<h1 class="ml10 column_head"><?=t('Лидеры партии')?></h1>
	<div class="box_content p10 ml10">
		<? foreach ( $leaders as $id ) { ?>
			<?=user_helper::photo($id, 's', array('class' => 'border1 m5'))?>
		<? } ?>
	</div>
<? } ?>