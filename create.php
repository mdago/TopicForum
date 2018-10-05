<?php

require('core/ini.php');
?>


<?php
//Create topic object
$topic = new Topic;

if(isset($_POST['do_create'])){
    
    //Create Validator object
    $validate = new Validator;

    //Create Data Array to contain create form information
    $data = array();
    $data['title'] = $_POST['title'];
    $data['body'] = $_POST['body'];
    $data['category_id'] = $_POST['category'];
    $data['user_id'] = getUser()['user_id'];
    $data['last_activity'] = date('Y-m-d H:i:s');

    //Required Fields
    $field_array = array('title', 'body', 'category');

    if($validate->isRequired($field_array)){
		//Register User
		if($topic->create($data)){
			redirect('index.php', 'Your topic has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('create.php', 'Please fill in all required fields', 'error');
	}

}

//Get Template and assign vars
$template = new Template('templates/create.php');

//Assign Vars

//Display template
echo $template;