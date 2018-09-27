<?php

require('core/ini.php');
?>


<?php

//Create Topic Object
$topic = new Topic();
//Get Template and assign vars
$template = new Template('templates/frontpage.php');

//Assign Vars
$template->topics = $topic->getAllTopics();
//Display template
echo $template;