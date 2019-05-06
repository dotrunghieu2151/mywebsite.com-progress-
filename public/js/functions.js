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
async function loadPage(url,contentDiv,direction = "forward",data = "ajax",method="POST"){
       if(direction === "forward") {
           if(url != window.location.href) {                    
                contentDiv.innerHTML = ''; 
                contentDiv.appendChild(loadingAni);
                loadingAni.style.display = "block";
                let response =  await get(url,data,method);
                loadingAni.style.display = "none";
                document.title = response.pageTitle;
                contentDiv.innerHTML = response.html;
                if (response.scriptsrc !== null) loadScript(response.scriptsrc);
                window.history.pushState({path:url,activelink:document.querySelector(".active").id},null,url);
            }
        }
        else if (direction === "back") {
            contentDiv.innerHTML = ''; 
            contentDiv.appendChild(loadingAni);
            contentDiv.style.display = "block";
            let response =  await get(url,data,method);
            document.title = response.pageTitle;
            contentDiv.innerHTML = response.html;
            if (response.scriptsrc !== null) loadScript(response.scriptsrc);
        }
}
function activeState(element){
        let activeEle = document.querySelector(".active");
        activeEle != null ? activeEle.classList.remove("active") : '';
        element.classList.add("active");
};