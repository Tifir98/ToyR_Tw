<?php

include_once 'Database.php';
include_once 'User.php';

$database = new Database();
$db = $database->connect();

$post = new User($db);
$post->email=$_POST['email'];
$post->parola=$_POST['psw'];

$result = $post->getUser();
$num = $result->rowCount();
$idResult = $post->getID();
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
$idRow=$idResult->fetch(PDO::FETCH_ASSOC);
extract($idRow);
if($num == 1 ) {
    if($type == 'user'){
      header("Location: Scripts/selectData.php?id= ". $id);
    }
    else
    if($type == 'admin')
    header("Location: Scripts/selectData.php?id= ". $id);
  }
}
?>

