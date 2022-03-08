<div class="clearfix"></div>
<?php 
if( !access_has_global_level( config_get( 'manage_user_threshold' ) ) ) {
	return;
}
include( config_get( 'plugin_path' ) . 'MonProj' . DIRECTORY_SEPARATOR .  'MonProj_api.php');  
global $t_user;
?>
<div class="space-10"></div>
<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
<h4 class="widget-title lighter">
<i class="ace-icon fa fa-puzzle-piece"></i>
<?php echo lang_get('add_monitor_title') ?>
</h4>
</div>

<div class="widget-body">
<div class="widget-main no-padding">
<div class="form-container">
<div class="table-responsive">
	<table class="table table-bordered table-condensed table-striped">
        <tr>
            <td class="category">
                <?php echo lang_get( 'projects_monitored' ) ?>
	   </td>
            <td><?php print_monproj_user_list($t_user['id'] ) ?></td>
        </tr>
        <form id="manage-monproj-add-form" method="post" action="plugins/MonProj/pages/manage_monitor_add.php ">
        <fieldset>
            <?php echo form_security_field( 'manage_user_proj_add' ) ?>
            <input type="hidden" name="user_id" value="<?php echo $t_user['id']?>" />
        <tr>
            <td class="category">
                <?php echo lang_get( 'projects_monitor_label' ) ?>
            </td>
            <td>
                <select id="add-user-project-id" name="project_id[]" class="input-sm" multiple="multiple" size="5">
                    <?php  print_monproj_user_list_option_list2( $t_user['id'] ) ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary btn-sm btn-white btn-round" value="<?php echo lang_get( 'add_monitor_button' ) ?>" />
            </td>
        </tr>
        </fieldset>
        </form>
	</table>
</div>
</div>
</div>
</div>
</div>
 