<?php
/*
require_once( 'core.php' );
require_once( 'bug_api.php' );
*/
$f_bug_id = gpc_get_int( 'bug_id' );
$t_bug = bug_get( $f_bug_id, true );
layout_page_header( bug_format_summary( $f_bug_id, SUMMARY_CAPTION ) );
layout_page_begin(  );

$g_issue_send = plugin_page( 'issue_send.php' );

# Send reminder Form BEGIN 
?>

<div align="center">
<form method="post" action="<?php echo $g_issue_send ?>">
<?php echo form_security_field( 'forward_issue' ) ?>
<input type="hidden" name="bug_id" value="<?php echo $f_bug_id ?>" />
<table class="width75" cellspacing="1">
<tr>
	<td class="form-title" colspan="2">
		<?php
		echo lang_get( 'plugin_forward_title' ) ;
		echo " => ";
		echo bug_format_summary( $f_bug_id, SUMMARY_CAPTION );
		?>
	</td>
</tr>
<tr>
	<td class="category">
		<?php echo lang_get( 'to' ) ?>
	</td>
	<td>
		<input type="text" size="100" maxlength="200" name="forward_address" value="<?php echo plugin_config_get( 'forward_address'  )?>"/>
	</td>

	</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'plugin_forward_message' ) ?>
	</td>

	<td class="center">
		<textarea name="body" cols="75" rows="10"></textarea>
	</td>

</tr>
<tr>
	<td class="center" colspan="2">
		<input type="submit" class="button" value="<?php echo lang_get( 'bug_send_button' ) ?>" />
	</td>
</tr>
</table>
</form>
<table class="width75" cellspacing="1">
<tr>
	<td class="center">
		<?php
			echo lang_get( 'plugin_forward_explain' ) . ' ';
		?>
	</td>
</tr>
</table>
</div>