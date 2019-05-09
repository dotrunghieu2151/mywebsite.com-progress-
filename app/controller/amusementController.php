<?php
class amusementController extends Controller {
   public function index() {
       if (filter_has_var(INPUT_POST, "getData") && $_POST["getData"] != 0) {
           $offset = $_POST["getData"];
       } else {
          $offset = 0;
       }
        $this->model("Amusement");
        $this->model->count();
        if ($offset >= (int)$this->model->getResult()[0]["COUNT"]){
            echo json_encode(["html"=>"no result found"]);
            exit();
        }
        $this->model->getAmusement($offset);
        $assoParam = helper::createAssoParams(["pageTitle","info","jsScript"],
                ["Mywebsite | Amusement",$this->model->getResult(),"search.js"]);
        $offset === 0 ? 
        $this->view("amusement".DS."index",$assoParam) :
        $this->view("amusement".DS."showmore",$assoParam);
    }
    public function search(){
        if (filter_has_var(INPUT_GET, "q")) {
            $q = trim($_GET["q"]," ");
            $this->model("Amusement");
            $q = $this->model->searchQuery($q);
            $this->model->count($q["whereQuery"],$q["whereParam"]);
            $totalResults = (int)$this->model->getResult()[0]["COUNT"];
            if (filter_has_var(INPUT_POST, "getData") && $_POST["getData"] != 0) {
                $offset = $_POST["getData"];
            } else {
                $offset = 0;
            }
            if ($offset >= $totalResults && $offset != 0){
                echo json_encode(["html"=>"no result found"]);
                exit();
            } elseif ($totalResults == 0) {
                $this->view("error".DS."noresult",["pageTitle"=>"Mywebsite"]);
                exit();
            }
            $this->model->getAmusement($offset,$q["whereQuery"],$q["whereParam"]);
            $assoParam = helper::createAssoParams(["pageTitle","info","jsScript"],
                ["Mywebsite | Amusement",$this->model->getResult(),"search.js"]);
            $offset === 0 ? 
            $this->view("amusement".DS."index",$assoParam) :
            $this->view("amusement".DS."showmore",$assoParam);          
        }
        else {
            header("Location: /mywebsite.com/amusement");
            exit();
        }
    }
    public function detail($urlName){
        if(empty($urlName)){
            header("Location: /mywebsite.com/amusement");
            exit();
        }
        $this->model("Amusement");
        $this->model->getDetail($urlName);
        $assoParam = helper::createAssoParams(["pageTitle","detail","jsScript"],
                ["Mywebsite | Amusements",$this->model->getResult(),"carousel-detail.js"]);
        $this->view("amusement".DS."detail",$assoParam);
    }
}
