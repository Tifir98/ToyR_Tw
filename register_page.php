<?php

include_once 'Database.php';
include_once 'User.php';
$database = new Database();
$db = $database->connect();
$post = new User($db);
$post->email=$_POST['email'];
$post->pass=$_POST['pass'];
$post->fname=$_POST['fname'];
$post->lname=$_POST['lname'];
$post->address=$_POST['address'];
$result;
if( strstr($post->email,'@') && strlen($post->pass) > 3  && strlen($post->pass) < 20 && strlen($post->fname) >= 2 && strlen($post->fname) <= 45 &&
strlen($post->lname) >= 2 && strlen($post->lname) <= 45 && strlen($post->address) >= 2 && strlen($post->address) < 100){
$result = $post->Insert();
}
if($result == True)
{
    header("Location: index.html");
}

header("Location: login_register.html");
?>