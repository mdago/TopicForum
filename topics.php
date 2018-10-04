<?php

require('core/ini.php');
?>


<?php
//Create Topic Object
$topic = new Topic;

//Get category from url
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get user from url
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

//Get Template and assign vars
$template = new Template('templates/topics.php');

//Assign Template Variables
if(isset($category)){
    $template->topics = $topic->getByCategory($category);
    $template->title = 'Posts In "' .$topic->getCategory($category)->name. '"';
}

//Check for the user filter
if(isset($user_id)){
    $template->topics = $topic->getByUser($user_id);
    //$template->title = 'Posts By "' . $user->getUser($user_id)->username. '"';
}

if(!isset($category) && !isset($user_id)){
    $template->topics = $topic->getAllTopics();
}

$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

//Display template
echo $template;