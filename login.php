<?php include('core/ini.php');?>

<?php

if(isset($_POST['do_login'])){

    //Get username and password
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //Create User Objec
    $user = new User;

    if($user->login($username, $password)){
        redirect('index.php', 'You have been logged in', 'success');
    }else{

        redirect('index.php', 'Login is not valid', 'error');
    }

}else{
    redirect('index.php');
}