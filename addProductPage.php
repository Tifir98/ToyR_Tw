<?php

include_once 'Database.php';
include_once 'Produs.php';
$database = new Database();
$db = $database->connect();
$post = new Produs($db);
$post->nume=$_POST['nume'];
$post->url=$_POST['url'];
$post->pret=$_POST['pret'];
$post->stoc=$_POST['stoc'];
$post->descriptie=$_POST['descriptie'];
$post->seller=$_POST['seller'];
$post->categorie=$_POST['categorie'];
$result = $post->Insert();

header("Location: salesReport.php");

?>