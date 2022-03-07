<html>
<body>
<?php 
	include 'templates/template_header.tpl';
?>
<h2>Account update</h2>
<?php 
	$t_message = lang_get( 'email_user_updated_msg' );
	$t_url = config_get( 'path' ) . 'account_page.php';
	$t_changes = $parameters['changes'];
?>
<p><?php echo lang_get( 'email_user_updated_msg' ); ?></p>
<a href="<?php echo $t_url; ?>"><span><?php echo $t_url; ?></span></a>
<p><?php echo $t_changes; ?></p>
<a href="http://www.mantisbt.org/" title="Free Web Based Bug Tracker"><img src="http://www.mantisbt.org/images/mantis_logo_button.gif" width="88" height="35" border="0" alt="Mantis Bug Tracker"></a><br/>
</body>
</html>
