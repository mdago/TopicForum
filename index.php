<?php

require('core/ini.php');
?>


<?php

//Create Topic and user Object
$topic = new Topic();
$user = new User;

//Get Template and assign vars
$template = new Template('templates/frontpage.php');

//Assign Vars
$template->topics = $topic->getAllTopics();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();
//Display template
echo $template;