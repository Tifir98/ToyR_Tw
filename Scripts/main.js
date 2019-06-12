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

    var rightLogo = document.getElementById("rightLogo");
    var rightLogoHeight = topBar.getBoundingClientRect().height / 2 - rightLogo.getBoundingClientRect().height / 2;
    // alert(topBar.getBoundingClientRect().height + " " + rightLogo.getBoundingClientRect().height + " " + rightLogoHeight);
    rightLogo.style.setProperty('top', rightLogoHeight + "px");

    
    
}

function onResizeWindow()
{
    var section = document.getElementById("section1");
    var topBar = document.getElementById("top-bar");
    section.style.top = "0";
    var sectionHeight = document.documentElement.clientHeight - (section.getBoundingClientRect().bottom) * 1.5;
    section.style.setProperty('top', sectionHeight + "px");

    var rightLogo = document.getElementById("rightLogo");
    var rightLogoHeight = topBar.getBoundingClientRect().height / 2 - rightLogo.getBoundingClientRect().height / 2;
    // alert(topBar.getBoundingClientRect().height + " " + rightLogo.getBoundingClientRect().height + " " + rightLogoHeight);
    rightLogo.style.setProperty('top', rightLogoHeight + "px");
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

function goHomePage()
{
    window.location.href = "index.html";
}

function goToCPanel(){
    window.location.href = "adminPage.html"
}
