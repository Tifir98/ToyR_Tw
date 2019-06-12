function goCart()
{
    window.location.href = "place_command.html";
}
function goShop()
{
    window.location.href = "categories.html";
}
function openPrompt()
{
    var prompt = document.getElementById("promptBox");
    prompt.style.display = "flex";
    document.body.style.background = "black";
    document.body.style.opacity = "0.75";
}
function orderPlaced()
{
    alert("Your order has been placed!");
}
