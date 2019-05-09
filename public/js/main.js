document.addEventListener("DOMContentLoaded",function(){
    // for active 
    const firstPageURL = window.location.href; 
    const firstActiveEle = document.querySelector(".active");
    // menu variables
    const pages = document.querySelectorAll(".webpage");
    // ajax loading varibles
    const loadingAni = document.querySelector(".loading-wrapper");
    const pageContent = document.querySelector(".page-content");  
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
        // for pagination
        if (e.target.classList.contains("pagination-link")) {
            e.preventDefault();
            let paginationURL = e.target.href;
            app.setURL(paginationURL).loadPage();
        }    
    }); 
});
   

    
   
   
     
