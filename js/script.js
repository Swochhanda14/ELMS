$(".menu > ul > li").click(function (e){

    // remove active from already active 
    $(this).siblings().removeClass("active");
    
    // add active
    $(this).toggleClass("active");
    
    // if it has sub menu open it
    $(this).find("ul").slideToggle();
    
    // close other sub menu if any open
    $(this).siblings().find("ul").slideUp();
    
    // remove active class of sub menu items
    $(this).siblings().find("ul").find("li").removeClass("active");
});

    
    
    // responsive nav 
    $(".menu-btn").click(function () {
        $(".sidebar").toggleClass("active");
    });



    document.querySelector("#show-action").addEventListener("click", () => {
        document.querySelector(".popup").classList.add("active");
    });
    
    document.querySelector(".popup .close-btn").addEventListener("click", () => {
        document.querySelector(".popup").classList.remove("active");
    });
    document.querySelector(".popup").addEventListener("click", (event) => {
        if (event.target === document.querySelector(".popup")) {
            document.querySelector(".popup").classList.remove("active");
        }
    });