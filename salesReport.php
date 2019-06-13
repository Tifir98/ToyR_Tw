<?php  
 function fetch_data()  
 {  
  include_once 'Database.php';
  $database = new Database();
  $db = $database->connect();
      $output = '';  
      $sql = "SELECT p.nume as nume,url,rating,pret,stoc,descriptie,seller,c.nume as categorie FROM Produs as p LEFT JOIN Categorii c on c.id=p.categorie";  
      $stmt =$db->prepare($sql);

      // Execute query
      $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
         $output .= '<tr>       
                          <td>'.$nume.'</td>  
                          <td>'.$url.'</td>  
                          <td>'.$rating.'</td>  
                          <td>'.$pret.' RON</td>
                          <td>'.$stoc.'</td>
                          <td>'.$descriptie.'</td>  
                          <td>'.$seller.'</td>
                          <td>'.$categorie.'</td>
                     </tr>  ';
  
      }

      return $output;  
 }  
 if(isset($_POST["create_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Raport:</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
           <td width="10%">Nume</td>  
           <td width="20%">Url</td>  
           <td width="10%">Rating</td>  
           <td width="10%">Pret</td>  
           <td width="10%">Stoc</td>  
           <td width="20%">Descriptie</td>  
           <td width="10%">Seller</td>  
           <td width="10%">Categorie</td>    
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
 }  
 else
 if(isset($_POST["create_csv"]))
 {
        $file_open = fopen("productReport.csv", "w");
        $no_rows = count(file("productReport.csv"));
        include_once 'Database.php';
        $database = new Database();
        $db = $database->connect();
            $output = '';  
            $sql = "SELECT p.nume as nume,url,rating,pret,stoc,descriptie,seller,c.nume as categorie FROM Produs as p LEFT JOIN Categorii c on c.id=p.categorie";  
            $stmt =$db->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
                           $form_data = array(
                                'nume'  => $nume,
                                'url'  => $url,
                                'rating' => $rating,
                                'pret'  => $pret.' RON',
                                'descriptie' => $descriptie,
                                'seller' => $seller,
                                'categorie' => $categorie
                        );
                        fputcsv($file_open, $form_data);
                }         
 }
 ?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/navigation.css">
    <link rel="stylesheet" href="Styles/command.css">
    <link rel="stylesheet" href="Styles/login.css">
    <title>ToyR - Sales Report</title>
    <script src="Scripts/main.js"></script>
    <script src="Scripts/shopping.js"></script>
    <script src="Scripts/selectTabs.js"></script>
</head>
<body onload="onLoad()">

        <?php include_once("Scripts/selectData.php"); 
              include_once("Scripts/echoData.php");
        ?>        

        <div id="bg">
            <img src="Images/background1.jpg" class="stretch" onclick="outsideBarClick()">
        </div>
        <nav id="top-bar">    
    
                <div class = "leftTopBar">
                    <button id="menu-icon" onclick=burgerClick()>
                       <i class = "fas fa-bars fa-2x"></i>  
                    </button>
            
                    <div class="search-box">
                            <input class="search-txt" type="text" name="" placeholder="Search for a toy!">
                            <a class="search-btn" href="#">
                                    <i class="fas fa-search"></i>
                            </a>
                    </div>
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
                     <h3 align="center">Raport:</h3><br />  
                     <div class="table-responsive" width="100%">  
                          <table  border="1">  
                               <tr>  
                                    <td width="10%">Nume</td>  
                                    <td width="20%">Url</td>  
                                    <td width="10%">Rating</td>  
                                    <td width="10%">Pret</td>  
                                    <td width="10%">Stoc</td>  
                                    <td width="20%">Descriptie</td>  
                                    <td width="10%">Seller</td>  
                                    <td width="10%">Categorie</td>  
                               </tr>  
                          <?php  
                          echo fetch_data();  
                          ?>  
                          </table>  
                          <br />  
                          <form method="post">  
                               <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                          </form>  
                          <form method="post">  
                               <input type="submit" name="create_csv" class="btn btn-danger" value="Create CSV" />  
                          </form>  
                     </div>  
                </div>  
    </body>
</html>


