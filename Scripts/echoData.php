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

function echoProduct(){

    $result = getProduct($_SESSION['prodId']);

    $id = $_SESSION['prodId'];
    $name = $result[0]['nume'];
    $url = $result[0]['url'];
    $price = $result[0]['pret'];
    $description = $result[0]['descriptie'];
    $category = getCategory($result[0]['categorie']);
    $categoryName = $category[0]['nume'];


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
        <span>$price</span>
        <a href=\"#\" class=\"cart-btn\" onclick=\"addToCart(this)\" data-name = \"$id\" data-value = \" $price\">Add to cart</a>
      </div>
    </div>";
}

?>