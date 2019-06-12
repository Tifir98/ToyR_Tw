<?php
class Sales{
    public $conn;
    public $table='Sales';
    public $id;
    public $idProdus;
    public $nume;

    public function __construct($db)
    {
        $this->conn=$db;
    }
    public function Insert(){
        $query = 'INSERT INTO ' .$this->table . ' SET id_produs = :idProdus,nume= :nume';
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(':idProdus', $this->idProdus);
        $stmt-> bindParam(':nume', $this->nume);
        if($stmt->execute()) {
            return true;
          }   
          printf("Error: $s.\n", $stmt->error);
          return false;
    }
    public function RemoveSales(){
        $query='DELETE FROM ' . $this->table . ' WHERE nume=:nume';
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(':nume', $this->nume);
        if($stmt->execute()) {
          return true;
        }   
        printf("Error: $s.\n", $stmt->error);
        return false;
    }
}

?>