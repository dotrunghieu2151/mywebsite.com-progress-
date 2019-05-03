<?php
class contactController extends Controller {
    public function index() {
        $AssoParams = helper::createAssoParams(["pageTitle"],["Contact Us"]);
        $this->view("contact".DS."contact",$AssoParams);
    }  
}
