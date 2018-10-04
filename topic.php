<?php

require('core/ini.php');
?>


<?php

//Create topic object
$topic = new Topic;

//Get Id From url
$topicId = $_GET['id'];
//Get Template and assign vars
$template = new Template('templates/topic.php');

//Assign Vars
$template->topic = $topic->getTopic($topicId);
$template->replies = $topic->getReplies($topicId);
$template->title = $topic->getTopic($topicId)->title;

//Display template
echo $template;