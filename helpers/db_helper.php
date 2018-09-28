<?php

/**
 * Get the number of replies per topic
 */
function replyCount($topic_id){

    $db = new Database;
    $db->query('SELECT * FROM replies WHERE topic_id = :topic_id');
    $db->bind(':topic_id', $topic_id);

    //Assigning rows to the result set
    $rows = $db->resultset();

    return $db->rowCount();
}

/**
 * get Categories
 */
function getCategories(){
    $db = new Database;
    $db->query('SELECT * FROM categories');

    $results = $db->resultset();
    return $results;
}