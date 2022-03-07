<html>
<body>
<?php 
	include 'templates/template_header.tpl';
?>
<h2>Reminder:</h2>
<?php 
	//require_api( 'string_api.php' );
	$t_bug_id = $parameters['bug_id'];
	$t_url = string_get_bug_view_url_with_fqdn( $t_bug_id, $parameters['recipient'] );
	$t_project_name = project_get_field( bug_get_field( $t_bug_id, 'project_id' ), 'name' );
	$t_date = date( config_get( 'normal_date_format' ) );
?>
<table>
<tr>
	<td>Issue:</td>
	<td><?php echo $t_project_name . ' ' . $t_bug_id ?></td>
</tr>
<tr>
    <td>Link:</td>
    <td><a href="<?php echo $t_url ?>" title="Free Web Based Bug Tracker"><span><?php echo $t_url ?></span></a></td>
</tr>
<tr><td>Date:</td><td><?php echo $t_date ?></td></tr>
<tr><td>Sender:</td><td><?php echo $parameters['sender'] ?></td></tr>
</table>
<h3>Message:</h3>
<?php echo $parameters['message'] ?><br/>
<hr>
<a href="http://www.mantisbt.org/" title="Free Web Based Bug Tracker"><img src="http://www.mantisbt.org/images/mantis_logo_button.gif" width="88" height="35" border="0" alt="Mantis Bug Tracker"></a><br/>
</body>
</html>
