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
$result = $post->Insert();

if($result == True)
{
    header("Location: index.html");
}
else
{
    header("Location: login_register.html");
}
?>