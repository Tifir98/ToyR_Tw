<?php

function echoSales(){
include_once("Database.php");
include_once("Sales.php");
$database = new Database();
$db = $database->connect();
$post = new Sales($db);

$result=$post->AllSales();

    foreach($result as $row)
    {
        $name=$row['nume'];
        echo "<div class=\"panelList\"><div class=\"productPanel\" data-name = \"$name\"  onclick = \"getSales(this)\"> $name</div></div>";
    }
}

?>