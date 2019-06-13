<?php
  class Produs {
    public $conn;
    public $idProdus;
    public $table = 'Produs';
    public $nume;
    public $url;
    public $rating = 0;
    public $pret;
    public $stoc;
    public $descriptie;
    public $seller;
    public $categorie;
    public function __construct($db) {
      $this->conn = $db;
    }

    public function Insert() {
      $query = 'INSERT INTO ' .$this->table . ' SET nume = :nume,url= :url,rating= :rating,pret= :pret,stoc= :stoc,descriptie=:descriptie,seller=:seller,
      categorie=:categorie';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(':nume', $this->nume);
      $stmt-> bindParam(':url', $this->url);
      $stmt-> bindParam(':rating', $this->rating);
      $stmt-> bindParam(':pret', $this->pret);
      $stmt-> bindParam(':descriptie', $this->descriptie);
      $stmt-> bindParam(':seller', $this->seller);
      $nameOfCategorie=$this->FindIdOfCategorie();
      //$nameOfCategorie = htmlspecialchars(strip_tags($nameOfCategorie));
      $stmt-> bindParam(':categorie', $nameOfCategorie);
      $stmt-> bindParam(':stoc', $this->stoc);
      if($stmt->execute()) {
        return true;
      }
      return false;
    }
    public function FindIdOfCategorie(){
      $query = 'SELECT id from Categorii where nume=:categorie ';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':categorie',$this->categorie);
      $stmt->execute();
      $idOfCategorie;
      while( $row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $idOfCategorie=$id;}
      return $idOfCategorie;
    }
    public function FindNameOfCategorie(){
      $query = 'SELECT nume from Categorii where id=:id ';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id',$this->idProdus);
      $stmt->execute();
      $nameOfCategorie;
      while( $row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $nameOfCategorie=$nume;}
      return $nameOfCategorie;
    }
    public function RemoveProduct(){
      $query='DELETE FROM ' . $this->table . ' WHERE  id=:id';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(':id', $this->id);
      if($stmt->execute()) {
        return true;
      }   
      printf("Error: $s.\n", $stmt->error);
      return false;
    }
  }?>
