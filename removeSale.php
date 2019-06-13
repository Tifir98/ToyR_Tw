<?php  
 function fetch_data()  
 {  
  include_once 'Database.php';
  $database = new Database();
  $db = $database->connect();
      $output = '';  
      $sql = 'SELECT DISTINCT s.nume as nume,p.seller as seller,c.nume as categorie,sum(p.pret) as total From Sales s Join Produs p on s.id_produs=p.id
      Join Categorii c on p.categorie=c.id Group by nume,seller,categorie,s.id';
      $stmt =$db->prepare($sql);
      $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
         $output .= ' <tr nume="user">       
                          <td>'.$nume.'</td>  
                          <td>'.$total.'</td> 
                          <td>'.$seller.'</td> 
                          <td>'.$categorie.'</td>                        
                        <td><button><a href="deleteSale.php?nume='.$nume.'">Delete</button></td>
                     </tr> ';
      }

      return $output;  
 }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnumeth=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/navigation.css">
    <title>ToyR - Remove Sale</title>
    <script src="Scripts/main.js"></script>
    <script src="Scripts/shopping.js"></script>
    <script src="Scripts/selectTabs.js"></script>
</head>
<body onload="onLoad()">
    
 <?php include_once("Scripts/selectData.php"); 
       include_once("Scripts/echoData.php");
 ?>

<div id="bg">
        <img src="Images/background1.jpg"class="stretch" onclick="outsideBarClick()">
    </div>
    <nav id="top-bar">    
    
    <div class = "leftTopBar">
        <button id="menu-icon" onclick=burgerClick()>
           <i class = "fas fa-bars fa-2x"></i>  
        </button>
<form class="search-box" action="script.php">
        <div>
                <input class="search-txt" type="text" name="toySearch" placeholder="Search for a toy!">
                <a class="search-btn" href="#" type="submit">
                        <i class="fas fa-search"></i>
                </a>
        </div>
</form>
    </div>

    <?php if(getUserType() == 1)
                echo "<div class=\"centerTopBar\"><button><i class=\"fas fa-user-lock\" onclick=\"goToCPanel()\"></i></button></div>";
    ?>
        

    <div id="rightTopBar">
            <img src="Images/toyr_logo.png" id="rightLogo" onclick="goHomePage()">
            <i class="fas fa-shopping-cart fa-2x" id="home-icon" onclick="goCart()"></i>
            <i class="fas fa-sign-out-alt fa-2x" onclick="logout()"></i>
    </div>

    </nav>
    
    <nav id="left-bar" class = "slideIn">
    <div class="items" id = "selected-item"> 
                    <span class="tabText"> Admin Options</span> 
                </div>
                <div class="items">
                        <a href="addProduct.html" style="color: black;"><span class="tabText"> Add Product</span> </a>
                </div>
                <div class="items">
                        <a href="addSales.php" style="color: black;"><span class="tabText"> Add Sales</span>
                </div>
                <div class="items">
                        <a href="salesReport.php" style="color: black;"><span class="tabText"> Sales Report</span>
                </div>
                <div class="items">
                        <a href="removeProduct.php" style="color: black;"><span class="tabText"> Remove Product</span>
                </div>
                <div class="items">
                        <a href="removeSale.php" style="color: black;"><span class="tabText"> Remove Sale</span>
                </div>
                <div class="items">
                        <a href="removeUser.php" style="color: black;"><span class="tabText"> Remove User</span>
                </div>
        <div id="companyLogo">
                <span class="tabText">© ToyR</span>
        </div>
    </nav>
    <br /><br />  
   <div class="container" style="width:100%;">  
   <h3 align="center">Remove Sales:</h3><br /> 
        <div class="table-responsive">  
        <table class="table table-bordered" border="1">  
        <tr>  
             <th width="25%">Nume</th>  
             <th width="25%">Total</th>   
             <th width="25%">Seller</th>  
             <th width="25%">Categorie</th> 
        </tr>  
   <?php  
   echo fetch_data();  
   ?>  
   </table>  
</div></div>  
</body>
</html>



