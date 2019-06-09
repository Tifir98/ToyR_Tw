<?php
include_once('selectData.php');

function echoCategories(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        $id = $row['id'];
        echo "<div class=\"panel\"><div class=\"categoryPanel\" data-name = \"$id\" onclick=\"getTabId(this)\">$name</div></div>";
    }
}

function echoLeftTab(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        $id = $row['id'];
        echo "<div class=\"items\"><span class=\"tabText\" data-name = \"$id\" onclick=\"getTabId(this)\"> $name</span></div>";
    }

}

?>