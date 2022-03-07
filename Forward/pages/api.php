<?php
$b_table = db_get_table('mantis_bugnote_table');
$bt_table = db_get_table('mantis_bugnote_text_table');


function savenote_query( $bug, $poster, $note ) {
    global $b_table;
    global $bt_table;

    $now = time();

    $note	= db_prepare_string( $note );

    # Add item to bugnotetext table
    $query = "INSERT INTO $bt_table ( note ) VALUES ( '$note' )";
    $res1 = db_query_bound($query);

    # Get the id fromt the bugnote entry
    $qli = "SELECT id FROM $bt_table WHERE note = '$note'";
    $res = db_query_bound($qli);
    $row = db_fetch_array($res);
    $bugnoteid = $row['id'];

    # Add item to bugnote table
    $query2 = "INSERT INTO $b_table ( bug_id, reporter_id, bugnote_text_id, last_modified, date_submitted )
               VALUES ( $bug, $poster, $bugnoteid, $now, $now )";
    $res2 = db_query_bound($query2);
}