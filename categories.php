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

    <div class = "title"><strong>Anything more specific in mind?</strong></div>

    <section id="section1"  onclick="outsideBarClick()">  
        <div class="panel"> <a href="bestSeller.html"><div class="categoryPanel">Most Wanted</div> </a></div>
        <div class="panel"><div class="categoryPanel">
            <?php 
            if( isset($_GET['id']) ){
            include_once 'Database.php';
            include_once 'User.php';

            $database = new Database();
            $db = $database->connect();
       
            $post = new User($db);
            $post->idUser=$_GET['id'];
            $Result = $post->getEmail();
            while($Row=$Result->fetch(PDO::FETCH_ASSOC)){
            extract($Row);
            echo $email;
        }}
        ?></div></div>
        <div class="panel"><div class="categoryPanel">Girls</div></div>
        <div class="panel"><div class="categoryPanel">Category4</div></div>
        <div class="panel"><div class="categoryPanel">Category5</div></div>
        <div class="panel"><div class="categoryPanel">Category6</div></div>
        <div class="panel"><div class="categoryPanel">Category7</div></div>
        <div class="panel"><div class="categoryPanel">Category8</div></div>
    </section>  
</body>
</html>