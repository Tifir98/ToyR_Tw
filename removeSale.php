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
    <title>ToyR - Categories</title>
    <script src="Scripts/main.js"></script>
    <script src="Scripts/shopping.js"></script>
</head>
<body onload="onLoad()">
    <div id="bg">
        <img src="Images/background1.jpg"class="stretch" onclick="outsideBarClick()">
    </div>
    <nav id="top-bar">    
    
    <div class = "leftTopBar">
        <button id="menu-icon" onclick=burgerClick()>
           <i class = "fas fa-bars fa-2x"></i>  
        </button>
        <form class="search-box" action="Scripts/searchScript.php" method="POST">
            <div>
                    <input class="search-txt" type="text" name="searchText" id="searchText" placeholder="Search for a toy!">
                    <a class="search-btn" type="submit">
                            <button type="submit"><i class="fas fa-search" ></i></button>
                    </a>
            </div>
    </form>
    </div>
        

    <div id="rightTopBar">
            <img src="Images/toyr_logo.png" id="rightLogo" onclick="goHomePage()">
            <i class="fas fa-shopping-cart fa-2x" id="home-icon" onclick="goCart()"></i>
    </div>

    </nav>
    
    <nav id="left-bar" class = "slideIn">
            <div class="items" id = "selected-item"> 
                    <span class="tabText"> Categories</span> 
                </div>
                <div class="items">
                   <a href="bestSeller.html" style="color: black;"> <span class="tabText"> Category 1</span> </a>
                </div>
                <div class="items">
                   <span class="tabText"> Category 2</span>
                </div>
                <div class="items">
                   <span class="tabText"> Category 3</span>
                </div>
                <div class="items">
                        <span class="tabText"> Category 4</span>
                </div>
                <div class="items">
                        <span class="tabText"> Category 5</span>
                </div>
                <div class="items">
                        <span class="tabText"> Category 6</span>
                </div>
                <div class="items">
                        <span class="tabText"> Category 7</span>
                </div>
                <div class="items">
                        <span class="tabText"> Category 8</span>
                </div>
        <div id="companyLogo">
                <span class="tabText">© ToyR</span>
        </div>
    </nav>
    <br /><br />  
   <div class="container" style="width:100%;">  
   <h3 align="center">Remove Sales:</h3><br /> 
        <div class="table-responsive">  
        <table class="table table-bordered">  
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



