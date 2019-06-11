<?php  
 function fetch_data()  
 {  
  include_once 'Database.php';
  $database = new Database();
  $db = $database->connect();
      $output = '';  
      $sql = 'SELECT p.id,p.nume as nume,rating,pret,stoc,seller, c.nume as categorie From Produs p LEFT JOIN Categorii c ON p.categorie=c.id';
      $stmt =$db->prepare($sql);
      $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
         $output .= ' <tr name="user">       
                          <td>'.$nume.'</td>  
                          <td>'.$rating.'</td>  
                          <td>'.$pret.' RON</td>  
                          <td>'.$stoc.'</td>
                          <td>'.$seller.'</td>
                          <td>'.$categorie.'</td>
                          <td><button><a href="deleteProduct.php?id='.$id.'"> Delete</button> </td>
                     </tr>   ';
      }
      return $output;  
 }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<form class="search-box" action="script.php">
        <div>
                <input class="search-txt" type="text" name="toySearch" placeholder="Search for a toy!">
                <a class="search-btn" href="#" type="submit">
                        <i class="fas fa-search"></i>
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
   <h3 align="center">Users:</h3><br /> 
        <div class="table-responsive">  
        <table class="table table-bordered">  
        <tr>  
             <th width="20%">Nume</th>  
             <th width="16%">Rating</th>  
             <th width="16%">Pret</th>  
             <th width="16%">Stoc</th>
             <th width="16%">Seller</th>
             <th width="16%">Categorie</th>   
        </tr>  
   <?php  
   echo fetch_data();  
   ?>  
   </table>  
</div></div>  
</body>
</html>


