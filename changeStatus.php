<?php

include_once 'Database.php';
$database = new Database();
$db = $database->connect();
$sql = "UPDATE Track_order SET status = :status , placed_at = :placed_at WHERE id = :id ";
    $stmt =$db->prepare($sql);
    $stmt->bindParam('id',$_GET['id']);
    $stmt->bindParam('status',$_POSt['categorie']);
    $newDate=date_default_timezone_get();
    $stmt->bindParam('placed_at',$newDate);
    $stmt->execute();

    header("Location: statusChange.html");
?>