<?php

/**
 * 
 * Redirection to Page
 * 
 */
function redirect($page = FALSE, $message = NULL, $message_type = NULL){

    if(is_string($page)){
        $location = $page;
    }else{
        $location = $_SERVER['SCRIPT_NAME'];
    }

    //Check for the message
    if($message != NULL){

        //Set the message
        $_SESSION['message'] = $message;
    }

    //Check for the message type
    if($message_type != NULL){

        //Set the message type
        $_SESSION['message_type'] = $message_type;
    }

    //Redirection
    header('Location: ' . $location);
    exit;
}