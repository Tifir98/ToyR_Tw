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

function getCartList($userId){
    $conn = getConnection();

    $sql = "SELECT * FROM Produs p JOIN Cos c ON p.id = c.Id_produs WHERE c.Id_User = \"$userId\"";

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

function getTotalPrice($userId){
    $conn = getConnection();

    $totalPrice = 0;

    $sql = "SELECT * FROM Produs p JOIN Cos c ON p.id = c.Id_produs WHERE c.Id_user = \"$userId\"";

    $query_result = mysqli_query($conn, $sql);

    while($row = $query_result->fetch_assoc()){
        $totalPrice += $row['Pret'];
    }

    return $totalPrice;
}

function getUserType(){
        
        if(!isset($_SESSION['loggedUser']))
          return 0;
    
        $conn = getConnection();

        $loggedUser = $_SESSION['loggedUser'];

        $sql = "SELECT * FROM User WHERE id = $loggedUser";

        $query_result = mysqli_query($conn, $sql);

        $res = $query_result->fetch_assoc();

        if($res['Type'] == "admin")
            return 1;
        else 
            return 0;
}


if(isset($_POST['catId'])){
    
    $_SESSION['catId'] = $_POST['catId'];

    echo 'productList.html';
}

if(isset($_POST['prodId']) && !isset($_POST['price'])){
    
    $_SESSION['prodId'] = $_POST['prodId'];

    echo 'product.html';
}

if(isset($_GET['id'])){
    $_SESSION['loggedUser'] = $_GET['id'];
    if(getUserType() == 0)
        header("Location: ../categories.html");
    elseif(getUserType() == 1)
        header("Location: ../adminPage.html");
}
?>