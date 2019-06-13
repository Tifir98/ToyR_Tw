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
        echo "<div class=\"items\" data-name = \"$id\" onclick=\"getTabId(this)\"><span class=\"tabText\" >$name </span></div>";
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

function echoOrderInfo(){
  if(isset($_SESSION['orderId']) && isset($_SESSION['loggedUser']));
    $res = getOrder($_SESSION['orderId']);

  if($res == "No order to be Tracked")
    echo "<h4>Your order info: No order to be Tracked";
  else{
    $updated_at = $res['placed_at'];
    $status = $res['status'];
    $expected_at = $res['expected_at'];

    echo "<h4>Your order info: </h4>
      <ul class=\"list-group\">
      <li class=\"list-group-item\">
                      <span class=\"prefix\">Last update:</span>
                      <span class=\"label label-success\">$updated_at</span>
                  </li>
                  <li class=\"list-group-item\">
                      <span class=\"prefix\">Order status:</span>
                      <span class=\"label label-success\">$status</span>
                  <li class=\"list-group-item\">
                      <span class=\"prefix\">Estimated arrival:</span>
                      <span class=\"label label-success\">$expected_at</span>

                  </a></li>
    </ul>";
  }
}

function echoComments(){
  $comments = getComments($_SESSION['prodId']);

  foreach($comments as $comment){

    $nume = getUserName($comment['id_user']);

    $comentariu = $comment['comment'];

    echo "<div class=\"friend\">
        <img src=\"https://image.flaticon.com/icons/svg/126/126486.svg\">

        <h3>$nume</h3>
        <p>$comentariu</p>
    </div>";
  }

}

function echoRating(){
  $rating = getRating($_SESSION['prodId']);

  $avg = $rating['average'];
  $total = $rating['totalNumber'];

  echo "<p>$avg average based on $total reviews.</p>";
   
}
?>