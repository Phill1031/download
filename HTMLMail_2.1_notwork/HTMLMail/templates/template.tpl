<html>
<body>
<?php 
	include 'template_header.tpl';
?>
<?php 
	$t_message_title = $parameters['message_title'];
	$t_bug_url = $parameters['email_bug_view_url'];
	$t_header_optional_params = $parameters['header_optional_params'];
	if( is_array( $t_header_optional_params ) ) {
		$t_message_title = vsprintf( $t_message_title, $t_header_optional_params );
	}
?>
<h3><?php echo $t_message_title ?></h3>
<?php 
	if( isset( $t_bug_url )) {
?>
    <a href="<?php echo $t_bug_url ?>"><span><?php echo $t_bug_url ?></span></a><br>
<?php
    }
?>

<?php 
	include 'template_body.tpl';
?>
</body>
</html>