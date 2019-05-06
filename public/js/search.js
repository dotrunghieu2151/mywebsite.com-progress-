$(document).ready(function(){
    console.log("this is search.js");
   // search variable
    let searchForm = document.querySelector(".search-form");
    let searchInput = document.querySelector("#search-input");
    let autocompleteContainer = document.querySelector(".autocomplete-container");
    const loadingAni = document.querySelector(".loading-wrapper");
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
        activeState(document.querySelector("#restaurant"));
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
});