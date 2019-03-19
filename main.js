var open = false;

function onLoad()
{
    open = false;
    document.getElementById("left-bar").style.display = "none";
    document.getElementById("menu-icon").style.left = "0";
    var section = document.getElementById("section1");
    var topBar = document.getElementById("top-bar");
    section.style.top = "0";
    var sectionHeight = document.documentElement.clientHeight - (section.getBoundingClientRect().bottom) * 1.5;
    section.style.setProperty('top', sectionHeight + "px");
}

function onResizeWindow()
{
    var section = document.getElementById("section1");
    var topBar = document.getElementById("top-bar");
    section.style.top = "0";
    var sectionHeight = document.documentElement.clientHeight - (section.getBoundingClientRect().bottom) * 1.5;
    section.style.setProperty('top', sectionHeight + "px");
}

window.onresize = onResizeWindow;

function burgerClick()
{
    var menu = document.getElementById("left-bar");
    var menuButton = document.getElementById("menu-icon");
    if(open == false)
        {
            menu.style.display = "block";
            menu.className = "menuSlideIn";
            menuButton.className = "iconSlideIn";
            menuButton.style.left = "11.7%";
            open = true;
        }
    else
        {
            menu.className = "menuSlideOut";
            // alert();
            menuButton.className = "iconSlideOut";
            menuButton.style.left = "0";
            open = false;
            // menu.style.display = "none";
        }
}