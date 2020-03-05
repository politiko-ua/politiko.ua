<script type="text/javascript">
	var context = {
		module: '<?=context::get_controller()->get_module() ?>',
		action: '<?=context::get_controller()->get_action() ?>',
		static_server: '<?=context::get('static_server')?>',
		host: '<?=context::get('host')?>',
		user_id: <?=session::is_authenticated() ? session::get_user_id() : 'null'?>,
		language: '<?=translate::get_lang()?>'
	};

	<?=client_helper::get_variables()?>
	<? if ( context::get('client_handler') ) { ?>
		$(document).ready( function() { <?=context::get('client_handler')?>; } );
	<? } ?>
</script>