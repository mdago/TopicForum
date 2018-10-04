<?php

require('core/ini.php');
?>


<?php
//Create topic, user, validate objects
$topic = new Topic;
$user = new User;
$validate = new Validator;


//Verifying if the register form has been sumbited
if(isset($_POST['register'])){

    //Create Data array for the information of the form
    $data = array();

    $data['name'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['username'] = $_POST['username'];
    $data['password'] = md5($_POST['password']);
    $data['password2'] = md5($_POST['passwod2']);
    $data['about'] = $_POST['about'];
    $data['last_activity'] = date("Y-m-d H:i:s");

    //Required Fields
	$field_array = array('name','email','username','password','password2');
	
	if($validate->isRequired($field_array)){
		if($validate->isValidEmail($data['email'])){
			if($validate->passwordsMatch($data['password'],$data['password2'])){
					//Upload Avatar Image
					if($user->uploadAvatar()){
						$data['avatar'] = $_FILES["avatar"]["name"];
					}else{
						$data['avatar'] = 'noimage.png';
					}
					//Register User
					if($user->register($data)){
						redirect('index.php', 'You are registered and can now log in', 'success');
					} else {
						redirect('index.php', 'Something went wrong with registration', 'error');
					}
			} else {
				redirect('register.php', 'Your passwords did not match', 'error');
			}
		} else {
			redirect('register.php', 'Please use a valid email address', 'error');
		}
	} else {
		redirect('register.php', 'Please fill in all required fields', 'error');
    }
    
}



//Get Template and assign vars
$template = new Template('templates/register.php');

//Assigns Vars

//Display template
echo $template;