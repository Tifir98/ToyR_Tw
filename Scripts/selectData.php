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

function getOrder($orderId){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];

    $sql = "SELECT * FROM Track_order WHERE id = $orderId AND user_id = $loggedUser";

    $query_result = mysqli_query($conn, $sql);

    $result = $query_result->fetch_assoc();

    if(!empty($result))
        return $result;
    else
        return "No order to be Tracked";
}

function getUserName($userId){
    $conn = getConnection();

    $sql = "SELECT Nume, Prenume FROM User WHERE id = $userId";

    $query_result = mysqli_query($conn, $sql);

    $result = $query_result->fetch_assoc();

    $return_data = $result['Nume'] . ' ' . $result['Prenume'];

    return $return_data;
}

function getComments($prodId){
    $conn = getConnection();

    $sql = "SELECT * FROM Rating WHERE id_produs = $prodId AND comentariu IS NOT NULL";

    $query_result = mysqli_query($conn, $sql);

    $return_data = array();

    while($row = $query_result->fetch_assoc()){
        array_push($return_data, array(
            "id" => $row['id'],
            "id_user" => $row['id_user'],
            "comment" => $row['comentariu']
        ));
    }

    return $return_data;

}

function getRating($prodId){
    $conn = getConnection();

    $sql = "SELECT ROUND(AVG(rating), 2) AS average, COUNT(*) AS totalNumber FROM Rating WHERE id_produs = \"$prodId\" AND rating IS NOT NULL";

    $query_result = mysqli_query($conn, $sql);

    $result = $query_result->fetch_assoc();

    return array(
        "average" => $result['average'],
        "totalNumber" => $result['totalNumber']
    );

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

function getOrder0(){
        $conn = getConnection();
        $sql = "SELECT t.id as id,u.nume as nume,t.status as status,t.placed_at as placed_at  FROM Track_order t join User u on t.user_id=u.id";
        $query_result = mysqli_query($conn, $sql);
        $return_data =array();
        while($row = $query_result->fetch_assoc()){
            array_push($return_data, array(
                'id' => $row['id'],
                'status' => $row['status'],
                'nume' => $row['nume'],
                'placed_at' =>$row['placed_at']
            ));
        }
        return $return_data;
    }

if(isset($_POST['saleName']))
{
    $_SESSION['saleName']=$_POST['saleName'];
    echo 'productSales.html';
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

if(isset($_GET['orderId']) && isset($_SESSION['loggedUser'])){
    $_SESSION['orderId'] = $_GET['orderId'];
    header("Location: ../orderTracker.html");
} elseif(isset($_GET['orderId']) && !isset($_SESSION['loggedUser'])){
    echo "No user logged in";
}
?>