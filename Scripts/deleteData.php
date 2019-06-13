<?php

include_once('selectData.php');

function deleteFromCart($delId){
    $conn = getConnection();

    $loggedUser = $_SESSION['loggedUser'];

    $sql = "DELETE FROM Cos WHERE Id_user = $loggedUser AND Id_produs = $delId";

    if(mysqli_query($conn, $sql)){
        echo "location.reload()";
    } else{
        echo die("Delete not working");
    }
}

if(isset($_POST['delete']) && $_POST['delete'] == 1){
    $_SESSION['delete'] = $_POST['delete'];
    echo "location.reload()";
}
elseif(isset($_POST['delete']) && $_POST['delete'] == 0){
    unset($_SESSION['delete']);
    echo "location.reload()";
}

if(isset($_POST['delId'])){
    deleteFromCart($_POST['delId']);
}

?>