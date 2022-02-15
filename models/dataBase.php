<?php

require 'connexion.php';

class Users extends Connexion{

    public $firstName ;
    public $userName ;
    public $lastName ;
    public $email ;
    public $password ;

    public function createAcount($firstName,$lastName,$emai,$password,$userName)
    {
        $insert = "insert into users (firstName,lastName,userName,email,password) Values ('$firstName','$lastName','$userName','$emai','$password')";
        $conn = $this->connect();
        mysqli_query($conn,$insert)or die(mysqli_error($conn));
    }

    public function loginCheck($userName,$password){
        $conn = $this->connect();
        $query = "select * from users where userName='" . $userName . "' and password='" . $password . "'";
        $res = mysqli_query($conn, $query);
    return $res;
    }

}


?>