<?php

require "../models/dataBase.php";

class LoginController extends Users
{
    
    function signUp()
    {
        $this->firstName = $_POST['FirstName'];
        $this->userName=$_POST['UserName'];
        $this->lastName=$_POST['LastName'];
        $this->email=$_POST['Email'];
        $this->password=$_POST['password'];

        $signUp = new Users();
        $signUp->createAcount($this->firstName,$this->lastName,$this->email,$this->password,$this->userName);
    }
    
    function login()
    {
        $userNM=$_POST['userName'];
        $pwd=$_POST['pwd'];

        $login = new Users();
        $resu=$login->loginCheck($userNM,$pwd);
        return $resu;
    }

}




if (isset ($_POST['submit_signin'])){
    $signUp = new LoginController();
    $signUp->signUp();
    header('location: ../views/login.php');
}
if (isset ($_POST['submit_login'])){

    $login = new LoginController();
    $result=$login->login();
    $getUser=mysqli_fetch_assoc($result);

    $id=$getUser['id'];
    $firstName=$getUser['firstName'];
    $lastName=$getUser['lastName'];

    if ($getUser) {
        header("location: ../views/myAcount.php?id=$id&firstName=$firstName&lastName=$lastName");
    } else {

        header('location: ../views/login.php');
    }
}

// $name = 'Abdelghafour belkhoukh';



?>