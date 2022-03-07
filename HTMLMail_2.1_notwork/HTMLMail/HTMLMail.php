<?php
# MantisBT - a php based bugtracking system

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
 * This plugin can reformat the mantis e-mails using the templates in the templates directory.
 *
 * @package BlackSun Plc.
 * @copyright Copyright (C) 2010 - 2011  Barnabas Sudy - bsudy@blacksunplc.com
 */
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );


class HTMLMailPlugin extends MantisPlugin {
	
	function register() {
		$this->name = "HTMLMail"; # Proper name of plugin
		$this->description = "HTML mail capability"; # Short description of the plugin
		$this->page = ""; # Default plugin page
		$this->version = "0.1"; # Plugin version string
		$this->requires = array( # Plugin dependencies, array of basename => version pairs
			'MantisCore' => '2.0.0', # Should always depend on an appropriate 
		);
		$this->author = "Black Sun Plc."; # Author/team name
		$this->contact = "bsudy@blacksunplc.com"; # Author/team e-mail address
		$this->url = ""; # Support webpage
	}
	
	function hooks() {
		return array(
			'EVENT_NOTIFY_EMAIL' => 'html_email_formatter',
		);
	}

	
	function html_email_formatter( $p_event, $p_email, $p_message_id, $p_params ) {
		if ( ( $t_template = $this->html_mail_load_template( $p_message_id ) ) !== false) { 
			
			
			$t_normal_date_format   = config_get( 'normal_date_format' );
			$t_complete_date_format = config_get( 'complete_date_format' );
			
			$t_message_title =  lang_get_defaulted( $p_message_id, null );
			
			$p_params['email_status_formatted']          = get_enum_element( 'status',          $p_params['email_status']          );
		    $p_params['email_severity_formatted']        = get_enum_element( 'severity',        $p_params['email_severity']        );
			$p_params['email_priority_formatted']        = get_enum_element( 'priority',        $p_params['email_priority']        );
			$p_params['email_reproducibility_formatted'] = get_enum_element( 'reproducibility', $p_params['email_reproducibility'] );
			
			$p_params['email_date_submitted_formatted']  = date( $t_complete_date_format, $p_params['email_date_submitted'] );
			$p_params['email_last_modified_formatted']   = date( $t_complete_date_format, $p_params['email_last_modified']  );
			
			$t_params = array_merge( $p_params, array( 'message_title' => $t_message_title , 'message_id' => $p_message_id, ) );
			$p_email->body = $this->html_mail_format($t_template, $t_params);
//			$p_email->body .= "\nMessage type: " . $p_message_id;
			$p_email->metadata['Content-Type'] = 'text/html';
//		} else {
//			$p_email->body .= "\nMessage type: " . $p_message_id;
		}
		return $p_email;
	}
	
	function html_mail_load_template($p_message_id) {
		$t_filename = config_get_global( 'plugin_path' ) . plugin_get_current() . '\\templates\\' . $p_message_id . ".tpl";
		if ( is_file( $t_filename ) && is_readable( $t_filename ) ) {
			$t_file = fopen( $t_filename, "r" );
			$t_content = fread( $t_file, filesize( $t_filename ) );
			fclose( $t_file );
			return $t_content;
		} else {
			return false;
		}
	}
	
	function array_to_table($array) {
		$paramtable = "<table>\n";
					
		foreach ($array as $key => $value) {
			$paramtable .= "<tr><td>$key</td><td>";
			if (is_array($value)) {
				$paramtable .= array_to_table($value);
			} else {
				$paramtable .= $value;
			}
			$paramtable .= "</td></tr>\n";
		}
		$paramtable .= "</table>\n";
		return $paramtable;
	}
	
	
	function html_mail_format($t_template, $parameters) {
		ob_start();
		$t_evalresult = eval("?>" . $t_template . "<?php ");
		$t_result = ob_get_contents();
		ob_end_clean();
		
		if ( $t_evalresult === false && ( $t_error = error_get_last() ) ) {
			return $t_template;
		} else {
			return $t_result;
		}
		
	}
	
}