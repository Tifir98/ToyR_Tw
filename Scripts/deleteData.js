function markItemsForRemoval(){
    var reqPOST = new XMLHttpRequest();

    var url = "Scripts/deleteData.php";

    var del = 1;

    var params = "delete=" + del;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");

    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            eval(reqPOST.responseText);
        }
    }

    reqPOST.send(params);

}

function unmarkItemsForRemoval(){
    var reqPOST = new XMLHttpRequest();

    var url = "Scripts/deleteData.php";

    var del = 0;

    var params = "delete=" + del;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");

    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            eval(reqPOST.responseText);
        }
    }

    reqPOST.send(params);

}

function removeItem(element){
    
    var reqDEL = new XMLHttpRequest();

    var url = "Scripts/deleteData.php";

    var prodId = element.getAttribute("data-name");

    var params = "delId=" + prodId;

    reqDEL.open("POST", url, true);

    reqDEL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqDEL.setRequestHeader("Content-length", params.length);
    reqDEL.setRequestHeader("Connection", "close");

    reqDEL.onreadystatechange = function(){
        if(reqDEL.readyState == 4 && reqDEL.status == 200){
            eval(reqDEL.responseText);
        }
    }

    reqDEL.send(params);

}