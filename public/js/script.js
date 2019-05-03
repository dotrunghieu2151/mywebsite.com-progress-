window.onload = () => {
    // for active 
    const firstPageURL = window.location.href; 
    const firstActiveEle = document.querySelector(".active");
    // menu variables
    const pages = document.querySelectorAll(".webpage");
    // ajax loading varibles
    const loadingAni = document.querySelector(".loading-wrapper");
    const pageContent = document.querySelector(".page-content");
    // search variables
    const searchForm = document.querySelector("#search-form");
    const searchInput = document.querySelector("#search-input");
    const autocompleteContainer = document.querySelector(".autocomplete-container");
    function activeState(element){
        let activeEle = document.querySelector(".active");
        activeEle != null ? activeEle.classList.remove("active") : '';
        element.classList.add("active");
    };
    // mimic jquery $() selector
   /* function $(selector) {
        return document.querySelector(selector);
    }; */
    function get(url,data,method) {
        return new Promise((resolve, reject) => {
          const req = new XMLHttpRequest();
          req.open(method, url);
          req.setRequestHeader('Content-type','application/x-www-form-urlencoded'); 
          req.onload = () => req.status === 200 ? resolve(req.response) : reject(Error(req.statusText));
          req.onerror = (e) => reject(Error(`Network Error: ${e}`));
          req.send("getData="+JSON.stringify(data));
        })
                .then((res) => {
                    return JSON.parse(res);
        })
                .catch(error => console.log(error) );
                
    }
    async function loadPage(url,direction = "forward",data = "ajax",method="POST"){
       if(direction === "forward") {
           if(url != window.location.href) {                    
                pageContent.innerHTML = ''; 
                pageContent.appendChild(loadingAni);
                loadingAni.style.display = "block";
                let response =  await get(url,data,method);
                loadingAni.style.display = "none";
                document.title = response.pageTitle;
                pageContent.innerHTML = response.html;
                window.history.pushState({path:url,activelink:document.querySelector(".active").id},null,url);
            }
        }
        else if (direction === "back") {
            pageContent.innerHTML = ''; 
            pageContent.appendChild(loadingAni);
            loadingAni.style.display = "block";
            let response =  await get(url,data,method);
            document.title = response.pageTitle;
            pageContent.innerHTML = response.html;
        }
    }
    window.addEventListener("popstate", function(e){
        previousPath =  e.state == null ?  firstPageURL : e.state.path;
        previousActive = e.state == null ? firstActiveEle : document.querySelector(`#${e.state.activelink}`);
        activeState(previousActive);
        loadPage(previousPath,"back");
    });
    for (let page of pages) {
        // for menu link
        page.addEventListener("click", function(e){
            e.preventDefault();
            activeState(this);
            loadPage(this.href);          
        });
    }
    pageContent.addEventListener("click", function(e){
        // for restaurant detail a link
       if (e.target.classList.contains("restaurant-detail")){
           e.preventDefault();
           let restaurantURL = e.target.href;
           loadPage(restaurantURL);
        }
        // for restaurant detail image link
        if (e.target.classList.contains("restaurant-image")) {
            e.preventDefault();
            let restaurantURL = e.target.parentNode.href;
            loadPage(restaurantURL);
        }
        // for pagination
        if (e.target.classList.contains("pagination-link")) {
            e.preventDefault();
            let paginationURL = e.target.href;
            loadPage(paginationURL);
        }    
    });
    autocompleteContainer.addEventListener("click", function(e){
         // for autocomplete;
        if (e.target.classList.contains("autocomplete-li")) {
            searchInput.value = e.target.innerHTML;
            autocompleteContainer.innerHTML = "";
        }
    });
    searchForm.addEventListener("submit",function(e){
       e.preventDefault();
       let input = searchInput.value;
       let url = input === "" ?  
       `http://localhost:81/mywebsite.com/restaurants` : `http://localhost:81/mywebsite.com/restaurants/search/${input}`;
       activeState(document.querySelector("#restaurant"));
       loadPage(url);
    });
    searchInput.addEventListener("input", async function(e){
        if (this.value === "") {
            autocompleteContainer.innerHTML = "";
            return false;
        }
        let url = "http://localhost:81/mywebsite.com/ajax/autocomplete";
        let response = await get(url,this.value,"POST");
        autocompleteContainer.innerHTML  = response.output === false ? "" : response.output;
    });    
};
