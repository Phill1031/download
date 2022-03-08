<?php
# MantisBT - A PHP based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package MantisBT
 * @copyright Copyright 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright 2002  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 *
 * @uses core.php
 * @uses api_token_api.php
 * @uses authentication_api.php
 * @uses current_user_api.php
 * @uses database_api.php
 * @uses html_api.php
 */

require_once( 'core.php' );
require_api( 'authentication_api.php' );
require_api( 'current_user_api.php' );
require_api( 'database_api.php' );
require_api( 'html_api.php' );

auth_ensure_user_authenticated();
auth_reauthenticate();

layout_page_header( lang_get( 'MonProj_title' ) );
layout_page_begin();
print_account_menu( 'select_projects.php' ); 
global $t_user; 
$t_user_id = auth_get_current_user_id(); 
$t_user = user_get_row( $t_user_id ); 
include( config_get( 'plugin_path' ) . 'MonProj' . DIRECTORY_SEPARATOR . 'pages'. DIRECTORY_SEPARATOR .  'manage_monitor.php');  

