<br/>
<h2>Informations:</h2>
<table>
	<tr><td><?php echo lang_get( 'email_reporter' ) ?></td><td><?php echo $parameters['email_reporter'] ?></td></tr>
    <tr><td><?php echo lang_get( 'email_handler' ) ?></td><td><?php echo $parameters['email_handler'] ?></td></tr>
    <tr><td></td><td></td></tr> 
    <tr><td><?php echo lang_get( 'email_project' ) ?></td><td><?php echo $parameters['email_project'] ?></td></tr>
    <tr><td><?php echo lang_get( 'email_bug' ) ?></td><td><?php echo $parameters['email_bug'] ?></td></tr>
    <tr><td><?php echo lang_get( 'email_category' ) ?></td><td><?php echo $parameters['email_category'] ?></td></tr>
    <tr><td><?php echo lang_get( 'email_reproducibility' ) ?></td><td><?php echo get_enum_element( 'reproducibility', $parameters['email_reproducibility'] ); ?></td></tr>
    <tr><td><?php echo lang_get( 'email_severity' ) ?> </td><td><?php echo get_enum_element( 'severity', $parameters['email_severity'] ) ?></td></tr>
    <tr><td><?php echo lang_get( 'email_priority' ) ?> </td><td><?php echo get_enum_element( 'priority', $parameters['email_priority'] ) ?></td></tr>
    <tr><td><?php echo lang_get( 'email_status' ) ?> </td><td><?php echo get_enum_element( 'status', $parameters['email_status'] ) ?></td></tr>
     
<?php 
        # custom fields formatting
    foreach( $parameters['custom_fields'] as $t_custom_field_name => $t_custom_field_data ) {
?>
        <tr>
            <td><?php echo lang_get_defaulted( $t_custom_field_name, null )?></td>
            <td><?php echo string_custom_field_value_for_email( $t_custom_field_data['value'], $t_custom_field_data['type'] )?></td>
        </tr>
        
<?php 
    }
?>
<?php 
    if( config_get( 'bug_resolved_status_threshold' ) <= $parameters['email_status'] ) {
        $parameters['email_resolution'] = get_enum_element( 'resolution', $parameters['email_resolution'] );
?>
   	    <tr><td><?php echo lang_get( 'email_resolution' ) ?></td><td><?php echo $parameters['email_resolution'] ?></td></tr>
        <tr><td><?php echo lang_get( 'email_fixed_in_version' ) ?></td><td><?php echo $parameters['email_fixed_in_version'] ?></td></tr>
<?php 
    }
?>

    <tr><td></td><td></td></tr>
    <tr><td><?php echo lang_get( 'email_date_submitted' ) ?></td><td><?php echo date( config_get( 'complete_date_format' ), $parameters['email_date_submitted'] ) ?></td></tr>
    <tr><td><?php echo lang_get( 'email_last_modified' ) ?></td><td><?php echo date( config_get( 'complete_date_format' ), $parameters['email_last_modified'] ) ?></td></tr>
    
    
    <tr><td><?php echo lang_get( 'email_reporter' ) ?></td><td><?php echo $parameters['email_reporter'] ?></td></tr>
    
	

    


</table>

<h2>Summary:</h2>
<?php echo $parameters['email_summary'] ?>

<h2>Description:</h2> 
<?php echo $parameters['email_description'] ?>

<?php 
	if ( !is_blank( $parameters['email_steps_to_reproduce'] ) ) {
        $t_message .= "\n" . lang_get( 'email_steps_to_reproduce' ) . ": \n" . $parameters['email_steps_to_reproduce'] . "\n";
    }

    if ( !is_blank( $parameters['email_additional_information'] ) ) {
        $t_message .= "\n" . lang_get( 'email_additional_information' ) . ": \n" . $parameters['email_additional_information'] . "\n";
    }

    if( isset( $parameters['relations'] ) ) {
        if( $parameters['relations'] != '' ) {
            echo lang_get( 'bug_relationships' ) . "<br/>\n" . lang_get( 'id' ) . lang_get( 'summary' ) . "<br/>\n" . $parameters['relations'];
        }
    }
?>
<?php 
	# Sponsorship
	if( isset( $parameters['sponsorship_total'] ) && ( $parameters['sponsorship_total'] > 0 ) ) {
		?><h2>Sponsorship</h2> <?php 
		echo sprintf( lang_get( 'total_sponsorship_amount' ), sponsorship_format_amount( $parameters['sponsorship_total'] ) ) . "<br/>\n" . "<br/>\n";

		if( isset( $parameters['sponsorships'] ) ) {
			foreach( $parameters['sponsorships'] as $t_sponsorship ) {
				$t_date_added = date( config_get( 'normal_date_format' ), $t_sponsorship->date_submitted );
				echo $t_date_added . ': ' . user_get_name( $t_sponsorship->user_id ) . ' (' . sponsorship_format_amount( $t_sponsorship->amount ) . ')' . " <br/>\n";
			}
		}
	}
?>

<?php if (array_key_exists( 'bugnotes', $parameters ) && !empty($parameters['bugnotes'])): ?>
<h2>Bugnotes:</h2>
<?php     # format bugnotes
	$t_normal_date_format = config_get( 'normal_date_format' );
    foreach( $parameters['bugnotes'] as $t_bugnote ) {
        $t_last_modified = date( $t_normal_date_format, $t_bugnote->last_modified );

        $t_formatted_bugnote_id = bugnote_format_id( $t_bugnote->id );
        $t_bugnote_link = string_process_bugnote_link( config_get( 'bugnote_link_tag' ) . $t_bugnote->id, false, false, true );

        if( $t_bugnote->time_tracking > 0 ) {
            $t_time_tracking = ' ' . lang_get( 'time_tracking' ) . ' ' . db_minutes_to_hhmm( $t_bugnote->time_tracking ) . "\n";
        } else {
            $t_time_tracking = '';
        }

        if( user_exists( $t_bugnote->reporter_id ) ) {
            $t_access_level = access_get_project_level( $parameters['email_project_id'] , $t_bugnote->reporter_id );
            $t_access_level_string = ' (' . get_enum_element( 'access_levels', $t_access_level ) . ') - ';
        } else {
            $t_access_level_string = '';
        }

        $t_string = ' (' . $t_formatted_bugnote_id . ') ' . user_get_name( $t_bugnote->reporter_id ) . $t_access_level_string . $t_last_modified . "\n" . $t_time_tracking . ' <a href=' . $t_bugnote_link . '>Link</a>';

        echo $t_email_separator2 . "<br/>\n";
        echo $t_string . "<br/>\n";
        echo "<hr/>\n";
        echo $t_bugnote->note . " <br/><br/>\n";
    }
?>
<?php endif; ?>
<?php if (array_key_exists( 'history', $parameters ) && !empty($parameters['history'])): ?>
    <h2>History:</h2>
    <table>
	    <tr>
	        <th>Date modified</th>
            <th>Username</th>
            <th>Field</th>
            <th>Change</th>
	    </tr>
        
<?php  
	$t_normal_date_format = config_get( 'normal_date_format' );
	foreach( $parameters['history'] as $t_raw_history_item ) { 
		$t_localized_item = history_localize_item( $t_raw_history_item['field'], $t_raw_history_item['type'], $t_raw_history_item['old_value'], $t_raw_history_item['new_value'], false );
?>
            <tr>
            <td><?php echo date( $t_normal_date_format, $t_raw_history_item['date'] ) ?></td>
            <td><?php echo $t_raw_history_item['username'] ?></td>
            <td><?php echo $t_localized_item['note'] ?></td>
            <td><?php echo $t_localized_item['change'] ?></td>
            </tr>
<?php
	}
?>
    </table>
<?php endif; ?>

<br/>
<a href="http://www.mantisbt.org/" title="Free Web Based Bug Tracker"><img src="http://www.mantisbt.org/images/mantis_logo_button.gif" width="88" height="35" border="0" alt="Mantis Bug Tracker"></a><br/>
