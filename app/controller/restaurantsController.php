<?php
class restaurantsController extends Controller {
    public function index() {
       $this->show("page1");
    }
    public function show($page){
        if (!preg_match("/^page\d+$/",$page)) {
            header("Location: /mywebsite.com/restaurants");
            exit();
        }
        $page = (int)str_replace("page", "", $page);
        $this->model("Restaurants");
        $this->model->count();
        $totalResults = (int)$this->model->getResult()[0]["COUNT"];
        $totalPages = ceil($totalResults/resultPerPage);       
        if ($page < 1) {
            $page = 1;
        }
        elseif ($page >$totalPages){
            $page = $totalPages;
        }
        $link = "http://localhost:81/mywebsite.com/restaurants/show/page";
        $link = View::paginate($totalPages,$page,$link);
        $this->model->getRestaurant($page);
        $assoParam = helper::createAssoParams(["pageTitle","resInfo","links","jsScript"],
                                              ["Mywebsite | Restaurants",$this->model->getResult(),$link,"/mywebsite.com/public/js/autocomplete.js"]);
        $this->view("restaurants".DS."index",$assoParam);
    }
    public function search(){
        if (filter_has_var(INPUT_GET, "q")) {
            if((!filter_has_var(INPUT_GET, "p")) || !preg_match("/[0-9]/",$_GET["p"])) {
                $page = 1;
            } else {
                $page = (int)$_GET["p"];
            }
            // remember to filter out empty string if something goes wrong
            // for multiple search $filteredQuery = explode(" ",urldecode($q));
            $_GET["q"] = trim($_GET["q"], " ");
            $filteredQuery = $_GET["q"];           
            $this->model("Restaurants");
            $filteredQuery = $this->model->searchQuery($filteredQuery);
            $this->model->count($filteredQuery["whereQuery"],$filteredQuery["whereParam"]);
            $totalResults = (int)$this->model->getResult()[0]["COUNT"];
            if ($totalResults == 0) {
                $this->view("error".DS."noresult",["pageTitle"=>"Mywebsite"]);
                exit();
            }
            $totalPages = ceil($totalResults/resultPerPage);
            if ($page < 1) {
                $page = 1;
            }
            elseif ($page >$totalPages){
                $page = $totalPages;
            }
            $link = "http://localhost:81/mywebsite.com/restaurants/search/?q={$_GET["q"]}&p=";
            $link = View::paginate($totalPages, $page, $link);
            $this->model->getRestaurant($page,$filteredQuery["whereQuery"],$filteredQuery["whereParam"]);
            $assoParam = helper::createAssoParams(["pageTitle","resInfo","links","jsScript"],
                    ["Mywebsite | Restaurants",$this->model->getResult(),$link,"/mywebsite.com/public/js/autocomplete.js"]);
            $this->view("restaurants".DS."index",$assoParam);
        } 
        else {
            header("Location: /mywebsite.com/restaurants");
            exit();
        }
    }
    public function detail($name = "") {
       if (empty($name)){
           header("Location: /mywebsite.com/restaurants");
           exit();
       }
       $this->model("Restaurants");
       $this->model->getDetail($name);
       $assoParam = helper::createAssoParams(["pageTitle","detail","jsScript"],
                         ["Mywebsite | Restaurants",$this->model->getResult(),"/mywebsite.com/public/js/carousel-detail.js"]);
       $this->view("restaurants".DS."detail",$assoParam);
    }
}
