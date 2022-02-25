<?php

session_start();

require "../models/dataBase.php";

class LoginController extends Users
{
    
    function signUp()
    {
        $this->firstName = ucfirst($_POST['FirstName']);
        $this->userName=$_POST['UserName'];
        $this->lastName=strtoupper($_POST['LastName']);
        $this->email=$_POST['Email'];
        $this->password=md5($_POST['password']);

        $signUp = new Users();
        $signUp->createAcount($this->firstName,$this->lastName,$this->email,$this->password,$this->userName);
    }
    
    function login()
    {
        $userNM=$_POST['userName'];
        $pwd=md5($_POST['pwd']);
        $login = new Users();
        $resu=$login->loginCheck($userNM,$pwd);
        return $resu;
    }
 
    
    

}


//create account
if (isset ($_POST['submit_signin'])){
    $signUp = new LoginController();
    $signUp->signUp();
    header('location: ../views/login.php');
}

//check account
if (isset ($_POST['submit_login'])){
    
    $login = new LoginController();
    $result=$login->login();
    $getUser=mysqli_fetch_assoc($result);

    if ($getUser) {
        $_SESSION['id']=$getUser['id'];
        $_SESSION['firstName']=$getUser['firstName'];
        $_SESSION['lastName']=$getUser['lastName'];
        $_SESSION['email']=$getUser['email'];
        header("location: ../views/myAcount.php");
    } else {
        header('location: ../views/login.php');
    }
}



//log out
if (isset ($_GET['logout'])){
    unset($_SESSION['id']);
    header('location: ../views/login.php');

}




?>