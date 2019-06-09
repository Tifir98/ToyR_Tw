<?php
    include_once 'removeSale.php';
    include_once 'Sales.php';
    include_once 'Database.php';
	if( isset($_GET['nume']) )
	{
        
        $database = new Database();
        $db = $database->connect();
        $sale = new Sales($db);
        $sale->nume = $_GET['nume'];
        $sale->RemoveSales();
		echo "<meta http-equiv='refresh' content='0;url=removeSale.php'>";
	}
?>