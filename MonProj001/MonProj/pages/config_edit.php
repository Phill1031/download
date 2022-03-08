<?php
// authenticate
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
// Read results
$f_MonProj_add_all = gpc_get_int( 'MonProj_add_all', ON );
$f_MonProj_remove_all = gpc_get_int( 'MonProj_remove_all', ON );
$f_MonProj_admin = gpc_get_int( 'MonProj_admin', [ADMINISTRATOR] );
// update results
plugin_config_set( 'MonProj_add_all', $f_MonProj_add_all );
plugin_config_set( 'MonProj_remove_all', $f_MonProj_remove_all );
plugin_config_set( 'MonProj_admin', $f_MonProj_admin );
// redirect
print_successful_redirect( plugin_page( 'config',TRUE ) );