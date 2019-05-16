<?php
class contactController extends Controller {
    public function index() {
        $AssoParams = helper::createAssoParams(["pageTitle"],["Contact Us"]);
        $this->view("contact".DS."contact",$AssoParams);
    }
    public function send(){
        if (filter_has_var(INPUT_POST, "contact-submit")) {
           $name = $_POST["name"];
           $email = $_POST["email"];
           $phone = $_POST["phone"];
           $message = $_POST["message"];
           $contactArray =[$name,$email,$phone,$message];
           $_SESSION["contactMes"] = "";
           if (in_array("",$contactArray)) {
               $_SESSION["contactMes"] = "<p class='errorMesRed'>Please fill in the missing fields</p>";
                header("Location: /mywebsite.com/contact");
                exit();
           }
           if (!regex::check_phone($phone)) {
               $_SESSION["contactMes"] .= "<p class='errorMesRed'>Invalid phone number</p>";
           }
           if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $_SESSION["contactMes"] .= "<p class='errorMesRed'>Invalid email</p>";
           }
           if ($_SESSION["contactMes"] !== "") {             
                header("Location: /mywebsite.com/contact");
                exit();
           }
           $this->model("Contact");
           $this->model->insert(["name"=>$name,"email"=>$email,"phone"=>$phone,"message"=>$message]);
           $_SESSION["contactMes"] = "<p style='color:green;'>Contact form sent!</p>";
        }
        header("Location: /mywebsite.com/contact");
    }
}
