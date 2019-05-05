<?php
class amusementController extends Controller {
   public function index() {
        $AssoParams = helper::createAssoParams(["pageTitle"],["Amusement"]);
        $this->view("amusement".DS."index",$AssoParams);
    }
}
