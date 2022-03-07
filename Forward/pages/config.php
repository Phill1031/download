<?php
	auth_reauthenticate();
	access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
	layout_page_header( lang_get( 'plugin_forward_title' ) );
	layout_page_begin();
	print_manage_menu();
?>
<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
	<?php echo form_security_field( 'plugin_forward_config_update' ) ?>

	<table align="center" class="width50" cellspacing="1">

		<tr>
			<td class="form-title" colspan="2">
				<?php echo lang_get( 'plugin_forward_title' ) . ': ' . lang_get( 'plugin_forward_config' )?>
			</td>
		</tr>

		<tr <?php echo helper_alternate_class() ?>>
			<td class="category">
				<?php echo lang_get( 'plugin_forward_threshold' ) ?>
			</td>
			<td class="center">
				<select name="forward_threshold">
				<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'forward_threshold'  ) ) ?>;
				</select>
			</td>
		</tr>

		<tr <?php echo helper_alternate_class() ?>>
			<td class="category">
				<?php echo lang_get( 'plugin_forward_address' ) ?>
			</td>
			<td class="center">
				<input type="text" size="30" maxlength="200" name="forward_address" value="<?php echo plugin_config_get( 'forward_address'  )?>"/>
			</td>
		</tr>
		
		<tr>
			<td class="center" colspan="3">
				<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
			</td>
		</tr>

	</table>
<form>

<?php
layout_page_end();