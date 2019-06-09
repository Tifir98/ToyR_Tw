<?php
include_once('selectData.php');

function echoCategories(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        echo "<div class=\"panel\"><div class=\"categoryPanel\">$name</div></div>";
    }
}

function echoLeftTab(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        echo "<div class=\"items\"><span class=\"tabText\"> $name</span></div>";
    }
}


?>