<?php

session_start();

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

function getCategory($catId){
    $conn = getConnection();

    $sql = "SELECT * FROM Categorii WHERE id = \"$catId\"";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    $row = $query_result->fetch_assoc();
    
    $return_data = array();

    array_push($return_data, array(
        "id" => $row['id'],
        "nume" => $row['nume']
    ));

    return $return_data;
}

function getProductList($catId){
    $conn = getConnection();

    $sql = "SELECT * FROM Produs WHERE categorie = \"$catId\"";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    while($row = $query_result->fetch_assoc()){
        array_push($return_data, array(
            'id' => $row['id'],
            'nume' => $row['Nume'],
            'url' => $row['Url'],
            'rating' => $row['Rating'],
            'pret' => $row['Pret'],
            'stoc' => $row['Stoc'],
            'descriptie' => $row['Descriptie'],
            'seller' => $row['Seller'],
            'categorie' => $row['Categorie']
        ));
    }

    return $return_data;
}

function getProduct($prodId){
    $conn = getConnection();

    $sql = "SELECT * FROM Produs WHERE id = \"$prodId\"";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    $row = $query_result->fetch_assoc();

    array_push($return_data, array(
        'id' => $row['id'],
        'nume' => $row['Nume'],
        'url' => $row['Url'],
        'rating' => $row['Rating'],
        'pret' => $row['Pret'],
        'stoc' => $row['Stoc'],
        'descriptie' => $row['Descriptie'],
        'seller' => $row['Seller'],
        'categorie' => $row['Categorie']
    ));

    return $return_data;
}
function getSales($salesName){
    $conn = getConnection();

    $sql = "SELECT id_produs FROM Sales WHERE nume = \"$salesName\"";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    while($row = $query_result->fetch_assoc()){
    array_push($return_data, array(
        'id_produs' => $row['id_produs']
        ));
    }
    return $return_data;
}

if(isset($_POST['catId'])){
    
    $_SESSION['catId'] = $_POST['catId'];

    echo 'productList.html';
}

if(isset($_POST['prodId'])){
    
    $_SESSION['prodId'] = $_POST['prodId'];

    echo 'product.html';
}

if(isset($_POST['saleName']))
{
    $_SESSION['saleName']=$_POST['saleName'];

    echo 'productSales.html';
}



?>