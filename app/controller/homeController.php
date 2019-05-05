<?php
class homeController extends Controller {
    public function index(){
        $AssoParams = helper::createAssoParams(["pageTitle","jsScript"],
                                               ["Home page","/mywebsite.com/public/js/carousel.js"]);
        $this->view("home".DS."index",$AssoParams);
    }
}
