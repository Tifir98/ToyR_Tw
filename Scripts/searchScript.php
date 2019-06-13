<?php

if(isset($_POST['searchText'])){

    header("Location: ../searchResult.html?searchText=". $_POST['searchText']);
}
    function echoSearchFind(){
if($_GET['searchText'] != NULL){
    include_once("echoData.php");
    include_once("./Database.php");
    include_once("./Produs.php");
    include_once("./Sales.php");
    $database = new Database();
    $db = $database->connect();
    
    $produsSearch = new Produs($db);
    $salesSearch = new Sales($db);
    $produsSearch->nume=$_GET['searchText'];
    $salesSearch->nume=$_GET['searchText'];
    $PSResult=$produsSearch->SearchProduct();
    $SSResult=$salesSearch->SearchSales();
    $count=0;
        foreach($PSResult as $row){
            $id = $row['id'];
            $url = $row['url'];
            $price = $row['pret'];
            $name = $row['nume'];
            echo "<div class=\"panelList\"><div class=\"productPanel\" data-name = \"$id\" onclick = \"getProductId(this)\"> $name</div></div>";
            $count=$count+1;
        }
        // foreach($SSResult as $row){
        //     $id = $row['id'];
        //     $name = $row['nume'];
        //     echo '<div class="panelList"><div class="productPanel" data-name ='.$id.' onclick = "getProductId(this)">'. $name.'</div></div>';
        //     $count=$count+1;
        //     }
        // }

    }
}
?>
