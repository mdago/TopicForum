<?php

require('core/ini.php');
?>


<?php
//Create Topic Object
$topic = new Topic;
//Get Template and assign vars
$template = new Template('templates/register.php');

//Assigns Vars

//Display template
echo $template;