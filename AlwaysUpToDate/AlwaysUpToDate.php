<?php

class AlwaysUpToDatePlugin extends MantisPlugin{
    
    function register( ) {
		$this->name = "AlwaysUpToDate";
		$this->description = "Adds a handler of a reported issue to the monitor list, if the issue is about to get reassigned.";
		$this->page = '';

		$this->version = '1.0';
		$this->requires = array(
			'MantisCore' => '1.2.0',
		);

		$this->author = 'n - i - i';
		$this->contact = 'nii42@hotmail.com';
		$this->url = '';
	}
    
    function hooks(){
        return array(
            'EVENT_UPDATE_BUG' => 'autdBugUpdated'
        );
    }
    
    function autdBugUpdated( $p_event, $p_bug_data, $p_bug_id ){
        
        # Did the handler change?
        $t_new_handler_id = $p_bug_data->handler_id;        
        $t_old_handler_id = bug_get_field( $p_bug_id, 'handler_id');
        
        # If yes, add the old handler to the monitor list
        if( $t_new_handler_id != $t_old_handler_id ){
            bug_monitor( $p_bug_id, $t_old_handler_id );
        }  
        
        # Since it's EVENT_TYPE_CHAIN and we do not want to change anything, we have to return null
        return null;
        
    }
}