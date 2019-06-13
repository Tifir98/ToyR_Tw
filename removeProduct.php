<?php  
 function fetch_data()  
 {  
  include_once 'Database.php';
  $database = new Database();
  $db = $database->connect();
      $output = '';  
      $sql = 'SELECT p.id as id,p.nume as nume,rating,pret,stoc,seller, c.nume as categorie From Produs p LEFT JOIN Categorii c ON p.categorie=c.id';
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
                          <td><button style:"background :none ;><a href="deleteProduct.php?idProdus='.$id.'"> Delete</button> </td>
                     </tr>';
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
        <form class="search-box" action="Scripts/searchScript.php" method="POST">
            <div>
                    <input class="search-txt" type="text" name="searchText" id="searchText" placeholder="Search for a toy!">
                    <a class="search-btn" type="submit">
                            <button type="submit"><i class="fas fa-search" ></i></button>
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
    </div>
    
    </nav>
    
    <nav id="left-bar" class = "slideIn">
    <div class="items" id="select-item" onclick="trackOrder()">
                                                View Order
                                              </div>
    <div class="items" id = "selected-item"> 
                                <span class="tabText"> Categories</span> 
                            </div>
                            <?php echoLeftTab(); ?>
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



