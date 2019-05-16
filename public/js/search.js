$(document).ready(function(){
   // search variable
    const searchForm = document.querySelector(".search-form");
    const searchInput = document.querySelector("#search-input");
    const autocompleteContainer = document.querySelector(".autocomplete-container");
    const amusementItems = document.querySelector(".amusement-items");
    const loadingAni = document.querySelector(".loading-wrapper");
    const amusementLoader = document.querySelector(".amusement-loader");
    const pageContent = document.querySelector(".page-content");
    if (searchForm !== null) {
    searchInput.addEventListener("input", async function(e){
             if (this.value === "") {
                 autocompleteContainer.innerHTML = "";
                 return false;
             }
             let url = `http://localhost:81/mywebsite.com/ajax/autocomplete/${searchForm.id}`;
             console.log(url);
             let autocomplete = new LoadAjax(null,null,this.value,"POST")
             let response = await autocomplete.setURL(url).get();
             autocompleteContainer.innerHTML  = response.output === false ? "" : response.output;
         });
     searchForm.addEventListener("submit",function(e){
        e.preventDefault();
        let input = searchInput.value;
        let url = input === "" ?  
        searchForm.action : `${searchForm.action}/search/?q=${input}`;       
        let searchAjax = new LoadAjax(pageContent,loadingAni);
        activeState(document.querySelector(`#${this.id}`));
        searchAjax.setURL(url).loadPage();
     });
     autocompleteContainer.addEventListener("click", function(e){
          // for autocomplete;
         if (e.target.classList.contains("autocomplete-li")) {
             searchInput.value = e.target.innerHTML;
             autocompleteContainer.innerHTML = "";
         }
     });
    }
   if (amusementItems !== null) {
       let offset = 0;
       let endOfData = false;
      $(window).scroll(async function(){
         if($(window).scrollTop() + $(window).height() + 50 >= $(document).height() ) {
             if (endOfData) {
                 return false;
             }
             else {
                offset += 12;
                const showmore = new LoadAjax(amusementItems,null, offset,"POST");
                amusementLoader.style.display = "block";
                const response = await showmore.setURL(window.location.href).get();                
                amusementLoader.style.display = "none";
                if (response.html !== "no result found") {
                     amusementItems.innerHTML += response.html;             
                } 
                else if (response.html === "no result found") {
                    endOfData = true;
                }
            }
         } 
      });
        if (getCookie("scrollPosition")) {
            $(window).scrollTop(getCookie("scrollPosition"));
            $('html, body').animate({
                   scrollTop: getCookie("scrollPosition")
            }, 500);
            eraseCookie("scrollPosition");
        }
   }
});