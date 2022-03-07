<html>
<body>
<?php 
	include 'templates/template_header.tpl';
?>
<h2>Password reset</h2>
<?php 
	$t_user_id = $parameters['user_id']; 
	$t_confirm_hash = $parameters['confirm_hash']; 
	$t_username = user_get_field( $t_user_id, 'username' );
	$t_url = string_get_confirm_hash_url( $t_user_id, $t_confirm_hash );
?>
<p><?php echo lang_get( 'reset_request_msg' ) ?></p>
<a href="<?php echo $t_url; ?>" title="Verfication link"><span><?php echo $t_url; ?></span></a> 
<br>
<table>
<tr><td><?php echo lang_get( 'new_account_username' ) ?></td><td><?php echo $t_username ?></td></tr>
<tr><td><?php echo lang_get( 'new_account_IP' ) ?></td><td><?php echo $_SERVER["REMOTE_ADDR"] ?></td></tr>
</table>
<p><?php echo lang_get( 'new_account_do_not_reply' ) ?></p>
<hr>
<a href="http://www.mantisbt.org/" title="Free Web Based Bug Tracker"><img src="http://www.mantisbt.org/images/mantis_logo_button.gif" width="88" height="35" border="0" alt="Mantis Bug Tracker"></a><br/>
</body>
</html>
