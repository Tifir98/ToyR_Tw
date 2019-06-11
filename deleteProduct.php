<?php
    include_once 'removeProduct.php';
    include_once 'Produs.php';
    include_once 'Database.php';
	if( isset($_GET['nume']) )
	{
        
        $database = new Database();
        $db = $database->connect();
        $produs = new Produs($db);
        $pordus->idProdus = $_Get['id'];
        $produs->nume = $_GET['nume'];
        $produs->seller = $_GET['seller'];
        $produs->categorie = $_GET['categorie'];  
        $produs->RemoveProduct();
		echo "<meta http-equiv='refresh' content='0;url=removeProduct.php'>";
	}
?>