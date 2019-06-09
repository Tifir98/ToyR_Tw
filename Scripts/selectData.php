<?php

function getConnection(){

    $DB_HOST = '35.198.68.195';
    $DB_USER = 'admin';
    $DB_PASS = 'admin';
    $DB_NAME = 'ToyR';

    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if(!$conn){
        echo die("Connection to DB failed: " . mysqli_connect_error());
    }
    
    return $conn;



}

function getCategories(){
    
    $conn = getConnection();

    $sql = "SELECT * FROM Categorii";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    while($row = $query_result->fetch_assoc()){
        array_push($return_data, array(
            'id' => $row['id'],
            'nume' => $row['nume']
        ));
    }

    return $return_data;

}

if(isset($_POST['catId'])){
    echo 'bestSeller.html';
}


?>