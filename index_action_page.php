<?php

include_once 'Database.php';
include_once 'User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new User($db);
$post->email=$_POST['email'];
$post->parola=$_POST['psw'];

// Blog post query

$result = $post->getUser();
// Get row count
$num = $result->rowCount();
// Check if any posts
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
if($num == 1 ) {
    if($type == 'user')
    header("Location: categories.html");
    else
    if($type == 'admin')
    header("Location: adminPage.html");
  }
}
?>

