<?php

require('core/ini.php');
?>


<?php
//Get Template and assign vars
$template = new Template('templates/frontpage.php');

//Assign Vars
$template->heading = 'This is the tempalte heading';
//Display template
echo $template;