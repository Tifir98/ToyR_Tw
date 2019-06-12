<?php

include_once('selectData.php');

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


?>