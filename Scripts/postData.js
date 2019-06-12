function addToCart(element){

    var reqPOST = new XMLHttpRequest();

    var prodId = element.getAttribute("data-name");
    var price = element.getAttribute("data-value");

    var url = "Scripts/postData.php";

    var params = "prodId=" + prodId + "&price=" + price;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");

    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            alert(reqPOST.responseText);
        }
    }

    reqPOST.send(params);

}

function logout(){
    var reqPOST = new XMLHttpRequest();

    var url = "Scripts/postData.php";

    var log = 1;

    var params = "logout=" + log;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");

    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            alert(reqPOST.responseText);
        }
    }

    reqPOST.send(params);
}