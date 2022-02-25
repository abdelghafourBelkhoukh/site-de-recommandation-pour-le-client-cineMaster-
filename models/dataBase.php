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

class Posts extends Connexion{

    public $title ;
    public $category ;
    public $description ;
    public $image ;
    public $authorId ;
    
    
    public function createPost($title,$category,$description,$image,$authorId)
    {
        $insert = "insert into posts (authorID,image,title,category,description) Values ('$authorId','$image','$title','$category','$description')";
        $conn = $this->connect();
        mysqli_query($conn,$insert)or die(mysqli_error($conn));
    }

    public function getPosts(){
        
        $conn = $this->connect();
        $query = "select * from posts ORDER BY id DESC";
        $res = mysqli_query($conn, $query);
        return $res;
    }

    function getAuthorName($id){
        $conn = $this->connect();
        $query = "SELECT  `firstName`, `lastName` FROM `users` WHERE `id`= $id ;";
        $res = mysqli_query($conn, $query);
        return $res;
    }

    function deletePost($id,$authorId){
        $conn = $this->connect();
        $query = "DELETE FROM `posts` WHERE `id`=$id and `authorID`=$authorId;";
        mysqli_query($conn, $query);
    }
    
    function editPost($id,$authorId){
        $conn = $this->connect();
        $query = "SELECT `id`, `authorID`, `image`, `title`, `category`, `description` FROM `posts` WHERE `id`=$id and `authorID`=$authorId;";
        $res = mysqli_query($conn, $query);
        return $res;
    }

    function UpdatePost($Update)
    {
        
    $conn = $this->connect();
    mysqli_query($conn, $Update);
    }
    
}

class Comments extends Connexion{

    public $id ;
    public $comment;
    public $postId ;
    public $authorId ;
    
    
    public function addComment($postId ,$comment,$authorId)
    {
        $insert = "INSERT INTO `comments`(`authorID`, `postID`, `comment`) VALUES ('$authorId','$postId','$comment')";
        $conn = $this->connect();
        mysqli_query($conn,$insert)or die(mysqli_error($conn));
    }

    public function getComments(){
        
        $conn = $this->connect();
        $query = "select * from comments";
        $query = "SELECT comments.id,comments.authorID ,comments.postID ,users.firstName ,users.lastName, comments.comment FROM comments INNER JOIN users ON comments.authorID=users.id ORDER BY id DESC;";
        $res = mysqli_query($conn, $query);
        return $res;
    }

    public function deleteComment($commentId,$authorId){
        $conn = $this->connect();
        $query = "DELETE FROM `comments` WHERE `id`=$commentId and `authorID`=$authorId;";
        mysqli_query($conn, $query);
    }


}
