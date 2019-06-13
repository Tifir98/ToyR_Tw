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
    echo "alert(\"User logged out\"); window.location.href = \"index.html\"";
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

function postComment(){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];
    $prodId = $_SESSION['prodId'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO Rating(id_produs, id_user, comentariu) VALUES(\"$prodId\", \"$loggedUser\", \"$comment\")";

    if(mysqli_query($conn, $sql)){
        header("Loctaion: ../product.html");
    } else{
        echo die("Error at insertion comment: " . mysqli_error($conn));
    }

}

function postRating(){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];
    $prodId = $_SESSION['prodId'];
    $rating = $_POST['rating'];

    $sql = "SELECT COUNT(*) AS count FROM Rating WHERE id_produs = $prodId AND id_user = $loggedUserAND COMENTARIU IS NULL";

    $query_result = mysqli_query($conn, $sql);

    if($query_result->fetch_assoc()['count'] == 0){
        $sql = "INSERT INTO Rating(id_produs, id_user, rating) VALUES(\"$prodId\", \"$loggedUser\", \"$rating\")";

        if(mysqli_query($conn, $sql)){
            header("Location: ../product.html");
        } else{
            echo die("Error at rating insertion:" . mysqli_error($conn));
        }
    } else{
        $sql = "UPDATE Rating SET rating = \"$rating\" WHERE id_user = \"$loggedUser\"";

        if(mysqli_query($conn, $sql)){
            header("Location: ../product.html");
        } else{
            echo die("Error at rating updare: " . mysqli_error($conn));
        }
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

if(isset($_POST['commentSubmit']) && isset($_SESSION['loggedUser'])){
    header("Location: ../product.html");
    postComment();
} elseif(isset($_POST['commentSubmit']) && !isset($_SESSION['loggedUser'])){
    echo "Must be logged in to comment";
}

if(isset($_POST['rating'])){
    // header("Location: ../product.html");
    postRating();
}

?>