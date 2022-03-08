<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
layout_page_header( lang_get( 'plugin_format_title' ) );
layout_page_begin( 'config_page.php' );
print_manage_menu();
?>
<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" > 
<br/>
<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo  'Project Monitoring : ' . lang_get( 'plugin_format_config' )?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive"> 
<table class="table table-bordered table-condensed table-striped"> 
<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<tr <?php echo helper_alternate_class() ?>>
<td class="category" colspan="3">

</td>
</tr>
<tr>
<td class="form-title" colspan="3">
<?php echo lang_get( 'MonProj_title' ) . ': ' . lang_get( 'MonProj_config' ) ?>
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><div align="center">
<?php echo lang_get( 'MonProj_admin' ) ?>
</td>
<td class="center"><div align="center">
<select name="MonProj_admin">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'MonProj_admin'  ) ) ?>;
</select> 
</td>
</tr>



<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="20%"><div align="center">
<?php echo lang_get( 'MonProj_add_all' )?>
</td>
<td class="center" width="70%"><div align="center">
<label><input type="radio" name='MonProj_add_all' value="1" <?php echo( ON == plugin_config_get( 'MonProj_add_all' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'MonProj_addall' )?></label>
<label><input type="radio" name='MonProj_add_all' value="0" <?php echo( OFF == plugin_config_get( 'MonProj_add_all' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'MonProj_onlynew' )?></label>
</td>
</tr> 

<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="20%"><div align="center">
<?php echo lang_get( 'MonProj_remove_all' )?>
</td>
<td class="center" width="70%"><div align="center">
<label><input type="radio" name='MonProj_remove_all' value="1" <?php echo( ON == plugin_config_get( 'MonProj_remove_all' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'MonProj_removeall' )?></label>
<label><input type="radio" name='MonProj_remove_all' value="0" <?php echo( OFF == plugin_config_get( 'MonProj_remove_all' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'MonProj_leave' )?></label>
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