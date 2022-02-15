<?php
require "login_controller.php";

class MyAccount extends LoginController
{
    public $id;
    public $firstName;
    public $lastName;
    
    function __construct()
    {
        $this->id = $_GET['id'];
        $this->firstName = $_GET['firstName'];
        $this->lastName = $_GET['lastName'];
    }


}







?>