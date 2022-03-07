<html>
<body>
<?php 
	include 'templates/template_header.tpl';
?>
<h2>Account registration</h2>
<?php 

	$t_admin_name = $parameters['admin_name'];
	$t_user_id = $parameters['user_id']; 
	$t_confirm_hash = $parameters['confirm_hash']; 
	$t_username = user_get_field( $t_user_id, 'username' );
	if( $t_admin_name ) {
		$intro_text = sprintf( lang_get( 'new_account_greeting_admincreated' ), $t_admin_name, $t_username );
	} else {
		$intro_text = sprintf( lang_get( 'new_account_greeting' ), $t_username );
	}
	$t_url = string_get_confirm_hash_url( $t_user_id, $t_confirm_hash );
?>
<p><?php echo $intro_text ?></p>
<a href="<?php echo $t_url; ?>" title="Verfication link"><span><?php echo $t_url; ?></span></a> 
<p><?php echo lang_get( 'new_account_message' ) ?></p>
<p><?php echo lang_get( 'new_account_do_not_reply' ) ?></p>
<hr>
<a href="http://www.mantisbt.org/" title="Free Web Based Bug Tracker"><img src="http://www.mantisbt.org/images/mantis_logo_button.gif" width="88" height="35" border="0" alt="Mantis Bug Tracker"></a><br/>
</body>
</html>
