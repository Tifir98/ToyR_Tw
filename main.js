var sideOpen = false;

function onLoad()
{
    sideOpen = false;
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
    if(sideOpen == false)
        {
            menu.style.display = "block";
            menu.className = "menuSlideIn";
            sideOpen = true;
        }
    else
        {
            menu.className = "menuSlideOut";
            sideOpen = false;
        }
}

function outsideBarClick()
{
    if(sideOpen == true)
    {
        var menu = document.getElementById("left-bar");
        menu.className = "menuSlideOut";
        sideOpen = false;
    }
}