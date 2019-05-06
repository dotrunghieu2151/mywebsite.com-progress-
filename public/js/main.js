class LoadAjax{
    constructor(contentDiv,loadAni,data="ajax",method="POST"){
        this.contentDiv = contentDiv;
        this.loadAni = loadAni;
        this.data = data;
        this.method = method;
    }
    setURL(url){
        this.requestURL = url;
        return this;
    }
    get(){
        return new Promise((resolve, reject) => {
          const req = new XMLHttpRequest();
          req.open(this.method, this.requestURL);
          req.setRequestHeader('Content-type','application/x-www-form-urlencoded'); 
          req.onload = () => req.status === 200 ? resolve(req.response) : reject(Error(req.statusText));
          req.onerror = (e) => reject(Error(`Network Error: ${e}`));
          req.send("getData="+JSON.stringify(this.data));
        })
                .then((res) => {
                    return JSON.parse(res);
        })
                .catch(error => console.log(error) );
                
    }
    async loadPage(is_pushState = true){
        if(is_pushState === true) {
           if(this.requestURL != window.location.href) {
                this.contentDiv.innerHTML = '';
                this.loadAni.style.display = "block";
                let response =  await this.get();
                this.loadAni.style.display = "none";
                document.title = response.pageTitle;
                this.contentDiv.innerHTML = response.html;
                if (response.scriptsrc !== null) this.loadScript(response.scriptsrc);
                window.history.pushState({path:this.requestURL,activelink:document.querySelector(".active").id},
                                             null,
                                             this.requestURL);
                }
            }
        else if (is_pushState === false) {
            this.contentDiv.innerHTML = ''; 
            this.loadAni.style.display = "block";
            let response =  await this.get();
            this.loadAni.style.display = "none";
            document.title = response.pageTitle;
            this.contentDiv.innerHTML = response.html;
            if (response.scriptsrc !== null) this.loadScript(response.scriptsrc);   
        }
    }
    loadScript(scriptsrc){
        console.log("loading script....");
        let js_script = document.createElement('script');
        if (document.querySelector(`script[src="${scriptsrc}"]`) != null ){
            document.querySelector(`script[src="${scriptsrc}"]`).outerHTML = '';
        }
        js_script.type = 'text/javascript';
        js_script.src = scriptsrc;
        js_script.async = true;
        document.getElementsByTagName('head')[0].appendChild(js_script);
    }   
};
function activeState(element){
        let activeEle = document.querySelector(".active");
        activeEle != null ? activeEle.classList.remove("active") : '';
        element.classList.add("active");
    };
document.addEventListener("DOMContentLoaded",function(){
    console.log("this is main.js");
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
        // for restaurant detail a link
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
        // for pagination
        if (e.target.classList.contains("pagination-link")) {
            e.preventDefault();
            let paginationURL = e.target.href;
            app.setURL(paginationURL).loadPage();
        }    
    }); 
});
   

    
   
   
     
