<?php
include_once ('postData.php');

    $result = getSales($_SESSION['saleName']);
    foreach($result as $row){ 
      addToCart($row['id_produs']);
  }
  http_response_code(200);
  header("Location: ../categories.html");
?>