document.addEventListener("DOMContentLoaded",function(){
    // for active 
    const firstPageURL = window.location.href; 
    const firstActiveEle = document.querySelector(".active");
    // menu variables
    const pages = document.querySelectorAll(".webpage");
    // ajax loading varibles
    const loadingAni = document.querySelector(".loading-wrapper");
    const pageContent = document.querySelector(".page-content");
    const ticketNotify = document.querySelector("#ticket-notify")
    let app = new LoadAjax(pageContent,loadingAni);
    // mimic jquery $() selector
   /* function $(selector) {
        return document.querySelector(selector);
    }; */
    window.addEventListener("popstate", function(e){ 
        previousPath =  e.state == null ?  firstPageURL : e.state.path;
        previousActive = e.state == null ? firstActiveEle : document.querySelector(`#${e.state.activelink}`);
        activeState(previousActive);
        app.setURL(previousPath).loadPage(false);
    });
    for (let page of pages) {
        // for menu link
        page.addEventListener("click", function(e){
            e.preventDefault();
            activeState(this);
            let url = this.href;
            app.setURL(url).loadPage();        
        });
    };
    pageContent.addEventListener("click", function(e){
       if (e.target.classList.contains("restaurant-detail")){
           e.preventDefault();
           let restaurantURL = e.target.href;
           app.setURL(restaurantURL).loadPage();
        }
        // for restaurant detail image link
        if (e.target.classList.contains("restaurant-image")) {
            e.preventDefault();
            let restaurantURL = e.target.parentNode.href;
            app.setURL(restaurantURL).loadPage();
        }
        // for amusement link 
        if (e.target.classList.contains("detail")){        
           e.preventDefault();
           setCookie("scrollPosition",$(window).scrollTop(),0.1);
           let amusementURL = $(e.target).closest(".amusement-detail").attr("href");
           app.setURL(amusementURL).loadPage();     
        }
        // for amusement add ticket button 
        if (e.target.classList.contains("add-ticket")) {
            e.preventDefault();
            let ticketLink = e.target.href;
            app.setURL(ticketLink).get()
                    .then(res => {
                        if (res.ticketNum === 0) {
                            ticketNotify.classList.add("hide");
                        } 
                        else if (res.ticketNum === 1) {
                            ticketNotify.classList.remove("hide");
                        }
                        ticketNotify.innerHTML = res.ticketNum;
                     if (e.target.innerHTML == "ADD TO MY VISIT") {
                         e.target.innerHTML = "REMOVE FROM MY VISIT";
                         e.target.href = ticketLink.replace("add","remove");
                     }
                     else if (e.target.innerHTML == "REMOVE FROM MY VISIT") {
                         e.target.innerHTML = "ADD TO MY VISIT";
                         e.target.href = ticketLink.replace("remove","add");
                     }
            });           
        }
        // for pagination
        if (e.target.classList.contains("pagination-link")) {
            e.preventDefault();
            let paginationURL = e.target.href;
            app.setURL(paginationURL).loadPage();
        }
        // for homepage readmore
        if (e.target.classList.contains("homepage-readmore")) {
            e.preventDefault();
            aboutpage = document.querySelector("#about");
            activeState( aboutpage);
            let url = e.target.href;
            app.setURL(url).loadPage();
        }
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
});

    
   
   
     
