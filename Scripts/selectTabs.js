// $(document).ready(function(){
//     $('div.categoryPanel').click(function(){
        
//         var catId = $(this).attr('data-name');

//         $.ajax({
//             url: 'selectData.php',
//             data: {"categoryId" : catId},
//             type: 'post'
//         });
//         window.location.href = "Scripts/selectData.php";

//     });
// });

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
            // alert(reqPOST.responseText);
            window.location.href = reqPOST.responseText;
        }
    }

    reqPOST.send(params);

    // window.location.href = "Scripts/selectData.php";
}