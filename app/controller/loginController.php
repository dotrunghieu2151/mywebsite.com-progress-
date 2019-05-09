<?php
class loginController extends Controller {
    public function index(){
        if(filter_has_var(INPUT_POST, "login-submit")){
            $usernameEmail = $_POST["usernameEmail"];
            $password = $_POST["password"];
            $_SESSION["errorMes"] = ["login"=>""];
            if (empty($usernameEmail) || empty($password)) {
                $_SESSION["errorMes"]["login"] = "please fill in the missing fields";
                $_SESSION["openLogin"] = "<script> $(document).ready(function(){ $('#login').modal('show'); }); </script>";              
                header("Location: /mywebsite.com/home");
                exit();
            }
            $this->model("AuthenUser",[$usernameEmail,$password,$usernameEmail]);
            $this->model->getUser();
            $result = $this->model->getResult()[0];
            if (count($this->model->getResult()) === 0) {
                $_SESSION["errorMes"]["login"] = "Can't find this user";
            } elseif (!$this->model->checkPass($result["password"])) {
                $_SESSION["errorMes"]["login"] = "Can't find this user";
            } elseif ($result["active"] != 1) {
                $_SESSION["errorMes"]["login"] = "Your account isn't verified. Please check your email and verify your account, or require a new verification request";
            }
            if (array_filter($_SESSION["errorMes"])) {
                $_SESSION["openLogin"] = "<script> $(document).ready(function(){ $('#login').modal('show'); }); </script>";              
                header("Location: /mywebsite.com/home");
                exit();
            }
            $_SESSION["user"] = ["id"=>$result["id"],"username"=>$result["user_name"]];
            header("Location: /mywebsite.com/home");
        }
        else {
            header("Location: /mywebsite.com/home");
            exit();
        }
    }
    public function forgetpass(){
        
    }
}
