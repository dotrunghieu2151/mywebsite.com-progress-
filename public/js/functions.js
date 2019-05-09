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
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/" + "; domain=localhost";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name + "= ; expires = Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=localhost"
}