<?php
include_once 'Database.php';
include_once 'Track_Order.php';
$database = new Database();
$db = $database->connect();
    $changeOrder = new Track($db);
    $changeOrder->idOrder=$_POST['id'];
    $changeOrder->status=$_POST['categorie'];
    $changeOrder->Update();
    header("Location: statusChange.html");
?>