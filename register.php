<?php

require('core/ini.php');
?>


<?php
//Create topic and user objects
$topic = new Topic;
$user = new User;


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

    //Avatar Image uploaded
    if($user->uploadAvatar()){
        $data['avatar'] = $_FILES["avatar"]["name"];
    }else{
        $data['avatar'] = 'noimage.png';
    }

    //Register User
    if($user->register($data)){
        redirect('index.php', 'You are registered and can now log in', 'success');
    }else{
        redirect('index.php', 'Something went wrong with the registration', 'error');
    }
}



//Get Template and assign vars
$template = new Template('templates/register.php');

//Assigns Vars

//Display template
echo $template;