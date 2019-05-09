<?php
class logoutController extends Controller {
    public function index(){
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        header('Location: /mywebsite.com/home');
        exit();
    }
}
