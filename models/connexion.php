<?php
class  Connexion 
{
    private $host="127.0.0.1";
    private $user="root";
    private $pass="";
    private $db="cinemaster";
    
    public function connect()
    {
        $conn=mysqli_connect($this->host,$this->user,$this->pass,$this->db);
        return $conn;
    }

}
?>