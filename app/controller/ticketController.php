<?php
class ticketController extends Controller {
    public function index(){
        $assoParam = helper::createAssoParams(["pageTitle","jsScript"], ["mywebsite.com | Tickets","ticket.js"]);
        if (!empty($_SESSION["ticket"])) {
            $this->model("Amusement");
            $this->model->getAmusementById($_SESSION["ticket"]);
            if ($this->model->getResult() !== "No results found") {
                $assoParam["ticketDetail"] = $this->model->getResult();
            }
        }        
        $this->view("ticket".DS."index",$assoParam);
    }
    public function handle($id = null){
        $this->model("Amusement");      
        if (!preg_match("/[1-9]/",$id) || !$this->model->is_exist($id)) {
            header("Location: /mywebsite.com/ticket");
            exit();
        }
        $result = $this->model->getResult();
        if(filter_has_var(INPUT_POST,"update-ticket")) {          
            $_SESSION["errorTicket"] = [];
            $_SESSION["errorTicket"][$id] = ["q"=>"","date"=>""];
            $date = $_POST["date"];
            list($qc,$qa,$qs) = [abs($_POST["qc"]),abs($_POST["qa"]),abs($_POST["qs"])];
            // check for quantity
            $totalQuantity = $qc + $qa + $qs;
            if ($totalQuantity == 0) {
                $_SESSION["errorTicket"][$id]["q"] = "Please specify ticket quantity!";
            } 
            elseif ( $totalQuantity > $result[0]["quantity"]) {
                 $_SESSION["errorTicket"][$id]["q"] = "Number of people can't not exceed ticket's quantity";
            }
            // check for date
            if (!$date) {
                $_SESSION["errorTicket"][$id]["date"] = "Missing date"; 
            }
            elseif(strtotime($date) < time()) {
                $_SESSION["errorTicket"][$id]["date"] = "Invalid date"; 
            } else {
              $new_date = date("m-d-Y",strtotime($date));
            }
            if (array_filter($_SESSION["errorTicket"][$id])) {
                if ($_POST["update-ticket"]= "ajax") {
                    $error = $_SESSION["errorTicket"][$id];
                    $error["status"] = "error";
                    echo json_encode($error);
                    exit();
                } else {
                    header("Location: /mywebsite.com/ticket");
                    exit();
                }
            }                  
            // get total  age discount maximum 20%
            $totalAgeDiscount = CHILDREN_DISCOUNT*$qc + SENIOR_DISCOUNT*$qs > 20 ? 20 : CHILDREN_DISCOUNT*$qc + SENIOR_DISCOUNT*$qs;
            // get discount if on weekends
             $weekendDiscount = helper::isWeekend($date) ? WEEKEND_DISCOUNT : 0;
            // get total price
            $price = $result[0]["price"] - $result[0]["price"]*$totalAgeDiscount/100 - $result[0]["price"]*$weekendDiscount/100;
            $totalPrice = $totalQuantity*$price;
            $_SESSION["ticketDetail"][$id] = ["totalPrice"=>$totalPrice,
                                              "totalQuantity"=>$totalQuantity,
                                              "price"=>$price,
                                             "qc"=>$qc,"qa"=>$qa,"qs"=>$qs,
                                             "date"=>$date,
                                            "wkDiscount"=>$weekendDiscount,
                                            "ageDiscount"=>$totalAgeDiscount,
                                            "name"=>$result[0]["name"],
                                            "id"=>$id];
            // get the sum of all tickets
            $_SESSION["sumOfTicket"] =  0;
            foreach ($_SESSION["ticketDetail"] as $ticket){
                $_SESSION["sumOfTicket"] += $ticket["totalPrice"];
            }
            if ($_POST["update-ticket"]= "ajax"){
                echo json_encode(["totalPrice"=> $_SESSION["sumOfTicket"],
                                  "ticketDetail"=>$_SESSION["ticketDetail"][$id]]);
                exit();
            }        
        } 
        elseif (filter_has_var(INPUT_POST, "remove-ticket")) {
            if (isset($_SESSION["ticketDetail"][$id])) {
                // subtract sum of all ticket
                if (isset($_SESSION["sumOfTicket"])){
                    $_SESSION["sumOfTicket"] -= $_SESSION["ticketDetail"][$id]["totalPrice"];
                } 
                unset($_SESSION["ticketDetail"][$id]);
                $_SESSION["ticketDetail"] = array_filter($_SESSION["ticketDetail"]);
            }
            $_SESSION["ticket"] = array_diff($_SESSION["ticket"], [$id]);                   
            if ($_POST["remove-ticket"]= "ajax"){
                echo json_encode(["tickNum"=>count($_SESSION["ticket"]),
                                   "totalPrice"=>$_SESSION["sumOfTicket"] ?? 0]);
                exit();
            }     
        }
        header("Location: /mywebsite.com/ticket"); 
    }
    public function pay() {
         foreach ($_SESSION["ticket"] as $key => $ticketId) {
                if (!isset($_SESSION["ticketDetail"][$ticketId])) {
                   $_SESSION["ticketError"] = "Please update all ticket details first!";
                   header("Location: /mywebsite.com/ticket");
                   exit();
                }
        }
        header("Location: /mywebsite.com/pay");      
    }
}
