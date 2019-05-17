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
            $result = $this->model->getResult();
            if ($result === "No results found") {
                $_SESSION["errorMes"]["login"] = "Can't find this user";
            } elseif (!$this->model->checkPass($result[0]["password"])) {
                $_SESSION["errorMes"]["login"] = "Can't find this user";
            } elseif ($result[0]["active"] != 1) {
                $_SESSION["errorMes"]["login"] = "Your account isn't verified. Please check your email and verify your account, or require a new verification request";
            }
            if (array_filter($_SESSION["errorMes"])) {
                $_SESSION["openLogin"] = "<script> $(document).ready(function(){ $('#login').modal('show'); }); </script>";              
                header("Location: /mywebsite.com/home");
                exit();
            }
            $_SESSION["user"] = ["id"=>$result[0]["id"],"username"=>$result[0]["user_name"]];
            if (filter_has_var(INPUT_POST, "remember")) {
                $this->model("AuthenToken");
                $token = AuthenToken::setToken(2592000);
                setcookie("remember", 
                          $token["selector"].":".$token["validator"], 
                          time() + 2592000, 
                          '/',false);
                $this->model->insertToken($result[0]["email"],$token);
            }
            header("Location: /mywebsite.com/home");
        }
        else {
            header("Location: /mywebsite.com/home");
            exit();
        }
    }
    public function forgetpass(){
        if (filter_has_var(INPUT_POST, "forgetpass-submit")) {
            $email = $_POST["email"];
            $_SESSION["message"] = "";
            $this->model("AuthenUser",["","",$email]);
            if(!$this->model->emailExist()){
                $_SESSION["message"] = "This user email doesn't exist";
                header("Location: /mywebsite.com/login/forgetpass");
                exit();
            }
            $token = AuthenToken::setToken();
            $this->model("AuthenToken");
            $this->model->deleteTokenByEmail($email);
            $this->model->insertToken($email,$token);
            $verifyURL = DOMAIN."/mywebsite.com/login/resetpass/?"."s={$token["selector"]}&v={$token["validator"]}";
            // send email
            $to = $email;
            $subject = "reset password for mywebsite.com";
            $message = "<p>We received a password reset request. The link to reset your account's password is below. If you did not make this request"
                . " ignore this email</p>"
                . "<p>Here is your password reset link: </br>"
                . "<a href='$verifyURL' >$verifyURL</a></p>";
            $headers = "From: test test <testmywebsite9@gmail.com\r\n"
                . "Reply-To: testmywebsite9@gmail.com\r\n"
                . "Content-type: text/html\r\n"; // to display html in the email
            $sendmail = mail($to, $subject, $message, $headers);
            if ($sendmail) {
                 $_SESSION["message"] = 'Mail sent. Check your email';
            } else {
                $_SESSION["message"] = 'Error. We could not send the email';
            }
            header("Location: /mywebsite.com/login/forgetpass");
        }
        else {
            $this->view("signupLogin".DS."forgetpass",["pageTitle"=>"reset your password"]);
        }
    }
    public function resetpass(){
        $selector = $_GET["s"];
        $validator = $_GET["v"];
        $url = "/mywebsite.com/login/resetpass/?"."s=$selector&v=$validator";
        If (filter_has_var(INPUT_POST, "resetpass-submit")){
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeatPassword"];
            if (empty($password) || empty($repeatPassword)) {
                $_SESSION["message"] = "Please fill in the missing fields";
            } 
            elseif ($password !== $repeatPassword) {
                $_SESSION["message"] = "repeat password does not match";
            } 
            elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',$password)) {
                $_SESSION["message"] = "Invalid password. Password must have minimum eight characters, at least one uppercase letter, one lowercase letter and one number";
            }
            if (!empty($_SESSION["message"])) {
                header("Location: $url");
                exit();
            }
            $this->model("AuthenToken");
            $tokenVerify = $this->model->checkToken($selector,$validator);      
            if(!$tokenVerify){
                $_SESSION["message"] = "You need to re-submit your request";
                header("Location: $url");
                exit();
            }
            $userEmail = $this->model->getResult()[0]["accountEmail"];
            $this->model->deleteTokenByEmail($userEmail);
            $this->model("AuthenUser",["",$password,$userEmail]);
            $this->model->resetPass();
            $_SESSION["resetPassMessage"] = "reset pass successful";
            $_SESSION["openLogin"] = "<script> $(document).ready(function(){ $('#login').modal('show'); }); </script>";
            header("Location: /mywebsite.com/home");
        }
        elseif (empty($selector) || empty($validator) ) {
            header("Location: /mywebsite.com/home");
            exit();
        }
        else {
            $this->view("signupLogin".DS."resetpass",["pageTitle"=>"mywebsite.com",
                                                    "token"=>["selector"=>$selector,"validator"=>$validator,"url"=>$url]]);
        }
    }
}
