function getTabId(element){
    var reqPOST = new XMLHttpRequest();

    var catId = element.getAttribute("data-name");

    var url = "Scripts/selectData.php";

    var params = "catId=" + catId;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");


    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            window.location.href = reqPOST.responseText;
        }
    }

    reqPOST.send(params);

}

function getProductId(element){
    var reqPOST = new XMLHttpRequest();

    var prodId = element.getAttribute("data-name");

    var url = "Scripts/selectData.php";

    var params = "prodId=" + prodId;

    reqPOST.open("POST", url, true);

    reqPOST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    reqPOST.setRequestHeader("Content-length", params.length);
    reqPOST.setRequestHeader("Connection", "close");

    reqPOST.onreadystatechange = function(){
        if(reqPOST.readyState == 4 && reqPOST.status == 200){
            window.location.href = reqPOST.responseText;
        }
    }

    reqPOST.send(params);
}
