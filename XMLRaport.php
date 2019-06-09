<?php
header("Content-type: text/xml");
echo"<?xml version='1.0' encoding='UTF-8'?>";
include_once 'Database.php';
$database = new Database();
$db = $database->connect();
    $output = '';  
    $sql = "SELECT nume,url,rating,pret,stoc,descriptie,seller,categorie FROM Produs ORDER BY id ASC";  

    $stmt =$db->prepare($sql);

    // Execute query
    $stmt->execute();
    echo"<article>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
    echo "<item>";
        echo"<Nume>". $nume . "</Nume>";
        echo"<Url>". $url . "</Url>";
        echo"<Rating>". $rating . "</Rating>";
        echo"<Pret>". $pret . "</Pret>";
        echo"<Stoc>". $stoc . "</Stoc>";
        echo"<Descriptie>". $descriptie . "</Descriptie>";
        echo"<Seller>". $seller . "</Seller>";
        echo"<Categorie>". $categorie . "</Categorie>";
    echo "</item>";
}
echo "</article>";
?>
