window.onload = () => {
    const searchForm = document.querySelector("#search-form");
    const searchInput = document.querySelector("#search-input");
    const autocompleteContainer = document.querySelector(".autocomplete-container");
    searchInput.addEventListener("input", async function(e){
            if (this.value === "") {
                autocompleteContainer.innerHTML = "";
                return false;
            }
            let url = "http://localhost:81/mywebsite.com/ajax/autocomplete";
            let response = await get(url,this.value,"POST");
            autocompleteContainer.innerHTML  = response.output === false ? "" : response.output;
        });
    searchForm.addEventListener("submit",function(e){
       e.preventDefault();
       let input = searchInput.value;
       let url = input === "" ?  
       searchForm.action : `${searchForm.action}/search/?q=${input}`;
       activeState(document.querySelector("#restaurant"));
       loadPage(url);
    });
    autocompleteContainer.addEventListener("click", function(e){
         // for autocomplete;
        if (e.target.classList.contains("autocomplete-li")) {
            searchInput.value = e.target.innerHTML;
            autocompleteContainer.innerHTML = "";
        }
    });   
};