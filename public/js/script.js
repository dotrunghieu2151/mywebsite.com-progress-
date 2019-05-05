window.onload = () => {
    // for active 
    const firstPageURL = window.location.href; 
    const firstActiveEle = document.querySelector(".active");
    // menu variables
    const pages = document.querySelectorAll(".webpage");
    // ajax loading varibles
    const loadingAni = document.querySelector(".loading-wrapper");
    const pageContent = document.querySelector(".page-content");  
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
    function loadScript(scriptsrc){
        let js_script = document.createElement('script');
        if (document.querySelector(`script[src="${scriptsrc}"]`) != null ){
            document.querySelector(`script[src="${scriptsrc}"]`).outerHTML = '';
        }
        js_script.type = 'text/javascript';
        js_script.src = scriptsrc;
        js_script.async = true;
        document.getElementsByTagName('head')[0].appendChild(js_script);
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
                if (response.scriptsrc !== null) loadScript(response.scriptsrc);
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
            if (response.scriptsrc !== null) loadScript(response.scriptsrc);
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
    };
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
};
