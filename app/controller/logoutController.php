<?php
class logoutController extends Controller {
    public function index(){
        unset($_SESSION["user"]);
        if (isset($_COOKIE["remember"])) {
           list($selector,$validator) = explode(":",$_COOKIE["remember"]);
           $this->model("AuthenToken");
           if ($this->model->checkToken($selector,$validator)) {
               $this->model->deleteTokenBySelector($selector);
               unset($_COOKIE['remember']);
               setcookie('remember', '', time() - 3600, '/', "localhost");
           }
        }     
        header('Location: /mywebsite.com/home');
        exit();
    }
}
