
Skip to content
Pull requests
Issues
Marketplace
Explore
@teodragoi

0
0

    0

Tifir-Marian/ToyR_Tw Private
Code
Issues 0
Pull requests 1
Projects 0
Security
Insights
ToyR_Tw/Sales.php
Tifir Worked on Sales 1f5b0cc 9 hours ago
52 lines (49 sloc) 1.5 KB
<?php
class Sales{
    public $conn;
    public $table='Sales';
    public $id;
    public $idProdus;
    public $nume;
    public $reducere;
    public function __construct($db)
    {
        $this->conn=$db;
    }
    public function Insert(){
        $query = 'INSERT INTO ' .$this->table . ' SET id_produs = :idProdus,nume= :nume, reducere=:reducere';
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(':idProdus', $this->idProdus);
        $stmt-> bindParam(':nume', $this->nume);
        $stmt-> bindParam(':reducere', $this->reducere);
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
    public function SearchSales(){
        $query='SELECT DISTINCT id,nume FROM ' . $this->table . ' WHERE lower(nume)=lower(:nume)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nume',$this->nume);
        $stmt->execute();
        return $stmt;
    }
    public function AllSales(){
        $query='SELECT DISTINCT nume From ' . $this->table ;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>

    © 2019 GitHub, Inc.
    Terms
    Privacy
    Security
    Status
    Help

    Contact GitHub
    Pricing
    API
    Training
    Blog
    About

