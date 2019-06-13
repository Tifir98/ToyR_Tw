<?php

include_once('selectData.php');

function echoCategories(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        $id = $row['id'];
        echo "<div class=\"panel\"><div class=\"categoryPanel\" data-name = \"$id\" onclick=\"getTabId(this)\">$name</div></div>";
    }
}

function echoLeftTab(){
    $result = getCategories();

    foreach($result as $row){
        $name = $row['nume'];
        $id = $row['id'];
        echo "<div class=\"items\"><span class=\"tabText\" data-name = \"$id\" onclick=\"getTabId(this)\">$name </span></div>";
    }
}


function echoProductList(){
    $result = getProductList($_SESSION['catId']);

    foreach($result as $row){
        $id = $row['id'];
        $name = $row['nume'];
        $url = $row['url'];
        $price = $row['pret'];
        echo "<div class=\"panelList\"><div class=\"productPanel\" data-name = \"$id\" onclick = \"getProductId(this)\"> $name</div></div>";
    }
}
function echoSalesList(){
  $result = getSales($_SESSION['saleName']);
  
  foreach($result as $row){ 
    $resultProduct = getProduct($row['id_produs']);
    foreach($resultProduct as $rowProduct){
      $id = $rowProduct['id'];
      $name = $rowProduct['nume'];
      $url = $rowProduct['url'];
      $price = $rowProduct['pret'];
      echo "<div class=\"panelList\"><div class=\"productPanel\" data-name = \"$id\" onclick = \"getProductId(this)\"> $name</div></div>";
    }

  }
}

function echoOrders(){
  $output='';
  $result = getOrder();
  foreach($result as $row){
    $status= $row['status'];
    $nume = $row['nume'];
    $placed_at=$row['placed_at'];
    $output .= '<form action="changeStatus.php" class="form-container" method="POST"><tr name="user">     
    <td>'.$nume.'</td>  
    <td>'.$status.'</td>  
    <td>'.$placed_at.'</td>  
    <td><select  name="categorie">
                    <option value="pending">pending</option>
                    <option value="accepted">accepted</option>
                    <option value="inbound">inbound</option>
                    <option value="delivered">delivered</option>
                    </select>
       <button type="submit" class="orderButton" name="id" value="'.$row['id'].'">Set</button></td></tr></form>';
  }
  echo $output;
}

function echoProduct(){

    $result = getProduct($_SESSION['prodId']);

    $id = $_SESSION['prodId'];
    $name = $result[0]['nume'];
    $url = $result[0]['url'];
    $price = $result[0]['pret'];
    $description = $result[0]['descriptie'];
    $category = getCategory($result[0]['categorie']);
    $categoryName = $category[0]['nume'];

    if(isset($_SESSION['loggedUser']))
      $str = "<a href=\"#\" class=\"cart-btn\" onclick=\"addToCart(this); openPrompt()\" data-name = \"$id\" data-value = \" $price\">Add to cart</a>";
    else     
      $str = "<a href=\"#\" class=\"cart-btn\" onclick=\"addToCart(this);\" data-name = \"$id\" data-value = \" $price\">Add to cart</a>";

    echo "<!-- Left Column / Product Image -->
    <div class=\"left-column\">
      <img data-image=\"red\" class=\"active\" src=\"$url\">
    </div>


    <!-- Right Column -->
    <div class=\"right-column\">

      <!-- Product Description -->
      <div class=\"product-description\">
        <span>$categoryName</span>
        <h1>$name</h1>
        <p>$description</p>
      </div>

      <!-- Product Configuration -->
      <div class=\"product-configuration\">

      <!-- Product Pricing -->
      <div class=\"product-price\">
        <span>$price</span>"
        . $str .
      "</div>
    </div>";
}

function echoCartList(){
  if(isset($_SESSION['loggedUser'])){

    $result = getCartList($_SESSION['loggedUser']);

  foreach($result as $row){
      $id = $row['id'];
      $name = $row['nume'];
      $price = $row['pret'];
      $htmlObj = "<div class=\"panel\"><div class=\"categoryPanel\" data-name = \"$id\" onclick = ";
      if(!isset($_SESSION['delete'])){
        $htmlObj = $htmlObj . "\"getProductId(this)\"> $name </div></div>";
      } else {
        $htmlObj = $htmlObj . "\"removeItem(this)\"> $name </div></div>";
      }
      echo $htmlObj;
  }
}
}

function echoTotalPrice(){
  $totalPrice = getTotalPrice($_SESSION['loggedUser']);

  echo $totalPrice;
}

?>