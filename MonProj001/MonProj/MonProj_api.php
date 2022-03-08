<?php
/**
 * list of projects that a user is NOT in
 * @param integer $p_user_id An user identifier.
 * @return void
 */
function print_monproj_user_list_option_list2( $p_user_id ) {
	db_param_push();
	$t_query = 'SELECT DISTINCT p.id, p.name
				FROM {project} p
				LEFT JOIN {plugin_MonProj_monitored_projects} u
				ON p.id=u.project_id AND u.user_id=' . db_param() . '
				WHERE p.enabled = ' . db_param() . ' AND
					u.user_id IS NULL
				ORDER BY p.name';
	$t_result = db_query( $t_query, array( (int)$p_user_id, true ) );
	while( $t_row = db_fetch_array( $t_result ) ) {
		$t_project_name = string_attribute( $t_row['name'] );
		$t_user_id = $t_row['id'];
		echo '<option value="' . $t_user_id . '">' . $t_project_name . '</option>';
	}
}

/**
 * list of projects that a user is in
 * @param integer $p_user_id             An user identifier.
 * @param boolean $p_include_remove_link Whether to display remove link.
 * @return void
 */
function print_monproj_user_list( $p_user_id, $p_include_remove_link = true ) {
	$t_projects = user_get_monitored_projects( $p_user_id );

	foreach( $t_projects as $t_project_id=>$t_project ) {
		$t_project_name = string_attribute( $t_project['name'] );
		if( $p_include_remove_link && access_has_project_level( config_get( 'project_user_threshold' ), $t_project_id ) ) {
			$link = 'plugins/MonProj/pages/manage_monitor_delete.php';
			$link .= "?project_id=". $t_project_id;
			$link .= "&user_id=". $p_user_id;
			echo "<a href='$link' >Remove &nbsp</a>";
		}
		echo $t_project_name;
		echo '<br />';
	}
} 


function user_get_monitored_projects( $p_user_id ) {
	db_param_push();
	$t_query = 'SELECT DISTINCT p.id, p.name
				FROM {project} p
				LEFT JOIN {plugin_MonProj_monitored_projects} u
				ON p.id=u.project_id
				WHERE p.enabled = \'1\' AND
					u.user_id=' . db_param() . '
				ORDER BY p.name';

	$t_result = db_query( $t_query, array( $p_user_id ) );
	$t_projects = array();
	while( $t_row = db_fetch_array( $t_result ) ) {
		$t_project_id = $t_row['id'];
		$t_projects[$t_project_id] = $t_row;
	}
	return $t_projects;
} 
