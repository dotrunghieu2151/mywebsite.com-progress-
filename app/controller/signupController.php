<?php
class signupController extends Controller {
    public function index(){
        if(filter_has_var(INPUT_POST, "signup-submit")){
            $_SESSION['errorMes'] = ['username'=>'','password'=>'','repeatPassword'=>'','email'=>''];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $repeatPassword = $_POST['repeatPassword'];
            // check for valid info
            if (empty($username)) {
                $_SESSION['errorMes']['username'] = "Please fill in the username";
            } elseif (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])(?=\S+$).{6,20}$/',$username)) {
                $_SESSION['errorMes']['username'] = "Invalid username. Username must have at least 6 characters with at least 1 number";
            }
            if (empty($password)){
                $_SESSION['errorMes']['password'] = "Please fill in the password";
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',$password)) {
                $_SESSION['errorMes']['password'] = "Invalid password. Password must have minimum eight characters, at least one uppercase letter, one lowercase letter and one number";
            }
            if (empty($repeatPassword)) {
               $_SESSION['errorMes']['repeatPassword'] = "Please repeat the password"; 
            } elseif($password !== $repeatPassword) {
                $_SESSION['errorMes']['repeatPassword'] = "repeat password doesn't match";
            }
            if (empty($email)){
               $_SESSION['errorMes']['email'] = "Please fill in the email";
            } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $_SESSION['errorMes']['email'] = 'Invalid email';
            }
            // check if username or email already exists.
            $this->model("AuthenUser",[$username,$password,$email]);
            if ($this->model->usernameExist()) {
                $_SESSION['errorMes']['username'] = 'username taken';
            }
            if ($this->model->emailExist()) {
                $_SESSION['errorMes']['email'] = 'email taken';
            }
            $returnEmail = htmlspecialchars($email);
            $returnUname = htmlspecialchars($username);
            // if all values in the $_SESSION['errorMes'] are not empty or not false, redirect
            if (array_filter($_SESSION['errorMes'])) {
                $_SESSION["openSignup"] = "<script> $(document).ready(function(){ $('#sign-up').modal('show'); }); </script>";              
                header("Location: /mywebsite.com/home?e=$returnEmail&u=$returnUname");
                exit();
            }
            $this->model->addUser();
            $token = AuthenUser::setToken();
            $this->model->insertToken($token);
            $verifyURL = DOMAIN."/mywebsite.com/signup/verify/?s="."{$token["selector"]}&v={$token["validator"]}";
            // send email
            $to = $email;
            $subject = "Verify your account for mywebsite.com";
            $message = "<p>We received an account verification request. The link to verify your account is below. If you did not make this request"
                . " ignore this email</p>"
                . "<p>Here is your account verification link: </br>"
                . "<a href='$verifyURL' >$verifyURL</a></p>";
            $headers = "From: spadar dante<dante.bloodhunter@gmail.com>\r\n"
                . "Reply-To: dante.bloodhunter@gmail.com\r\n"
                . "Content-type: text/html\r\n"; // to display html in the email
            $sendmail = mail($to, $subject, $message, $headers);
            if ($sendmail) {
                echo 'mail sent. Check your email';
            } else {
                echo 'error';
            }       
        }
        else {
            header("Location: /mywebsite.com/home");
            exit();
        }
    }
    public function verify(){
        $selector = $_GET["s"];
        $validator = $_GET["v"];
        if (empty($selector) || empty($validator) ||
            ctype_xdigit($selector)=== false || ctype_xdigit($validator) === false) {
            echo "We could not validate your request! Please make sure this is the right link";
            exit();
        }
        $this->model("AuthenUser");
        $tokenVerify = $this->model->checkToken($selector,$validator);
        $userEmail = $this->model->getResult()[0]["accountEmail"];
        if(!$tokenVerify){
            echo "You need to re-submit your request";
            exit();
        }
        $this->model->setActiveAccount($userEmail);
        echo "account active set";
    }
}