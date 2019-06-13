<?php

    include_once 'Produs.php';
    include_once 'Database.php';
        
        $database = new Database();
        $db = $database->connect();
        $produs = new Produs($db);
        $produs->idProdus = $_GET['idProdus'];
        $produs->RemoveProduct();
        header("Location: removeProduct.php");
		//echo "<meta http-equiv='refresh' content='0;url=removeProduct.php'>";
?>