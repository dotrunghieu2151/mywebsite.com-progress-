<?php
class aboutController extends Controller {
    public function index() {
        $AssoParams = helper::createAssoParams(["pageTitle"],["About Us"]);
        $this->view("about".DS."about",$AssoParams);
    }
}
