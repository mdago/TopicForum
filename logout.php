<?php include('core/ini.php');?>

<?php

if(isset($_POST['do_logout'])){

    //Create User Object
    $user = new User;

    if($user->logout()){
        redirect('index.php', 'You are now logged out', 'success');
    }
}else {
    redirect('index.php');
}

