<?PHP
# this code only kicks in when a new bug is being created
#
$sp_table		= plugin_table('monitored_projects','MonProj');
$bug_table		= db_get_table('mantis_bug_table'); 
$monitor_table	= db_get_table('mantis_bug_monitor_table'); 
$t_issue_id = $p_bugdata->id;
#
# first retrieve the project_id of the new issue
#
$sql= "select project_id from $bug_table where id=$t_issue_id";
$result = db_query($sql);
$row = db_fetch_array($result) ;
$t_project_id = $row['project_id'];
#
# Now check if users want to monitor this project
#
$sql 	=  "select user_id from $sp_table where  project_id=$t_project_id";
$result	= db_query($sql);
while ($row = db_fetch_array($result)) {
	$t_user_id = $row['user_id'];
	#	Has this user authorization to monitor for this project ?
	if (access_has_project_level(config_get( 'monitor_bug_threshold' ),$t_project_id,$t_user_id)){
		# now we need to check if monitoring is already enabled
		# check bug_monitored table for issue
		$sql2 = "select * from $monitor_table where user_id=$t_user_id and bug_id=$t_issue_id";
		$result2	= db_query($sql2);
		# if not yet, add monitoring 
		if (db_num_rows($result2) <1 ){
			bug_monitor( $t_issue_id, $t_user_id ); 
		}
	}
}