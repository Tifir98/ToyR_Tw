<?php

include_once('selectData.php');
include_once('deleteData.php');

function addToCart($prodId){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];


    $sql = "INSERT INTO Cos(Id_user, Id_produs) VALUES(\"$loggedUser\", \"$prodId\")";

    if(mysqli_query($conn, $sql)){
        http_response_code(201);
    }
    else{
        echo die("Error at insertion");
    }
}

function logout(){
    unset($_SESSION['loggedUser']);
    echo "User logged out";
}

function placeOrder(){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];
    $date = date("Y/m/d");
    $random_value = rand(1, 5);
    $expected_date = date("Y/m/d", + strtotime($date. "+ $random_value days"));

    $cart_list = getCartList($loggedUser);

    if(empty($cart_list))
        echo "alert(\"No products in Cart\")";
    foreach($cart_list as $cart_item){
        deleteFromCart($cart_item['id']);
    }
    
    $sql = "INSERT INTO Track_order(user_id, status, placed_at, expected_at) VALUES(\"$loggedUser\", \"Pending\", \"$date\", \"$expected_date\")";

    if(!mysqli_query($conn, $sql)){
        echo die("Error at insertion: " . mysqli_error($conn));
    }
}

if(isset($_POST['prodId'])){
    if(isset($_SESSION['loggedUser'])){
        addToCart($_POST['prodId']);
    }
    else
      echo "Please log in";  
}

if(isset($_POST['logout'])){
    logout();
}

if(isset($_POST['placeOrder'])){
    if(!isset($_SESSION['loggedUser']))
        echo "You have to be logged in to place an order!";
    else{
        placeOrder();
    }
}

?>