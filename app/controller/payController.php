<?php
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
class payController extends Controller {
    protected $apiContext;
    protected $total;
    protected $tax;
    protected $subtotal;
    public function __construct(){
        require_once VENDOR."autoload.php";   
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                CLIENT_ID,     // ClientID
                CLIENT_SECRET      // ClientSecret
            )
        );
        $this->tax = (10/100)*$_SESSION["sumOfTicket"];
        $this->subtotal =$_SESSION["sumOfTicket"];
        $this->total = $_SESSION["sumOfTicket"] + $this->tax;
    }
    public function index(){           
            $payer = new Payer;
            $payer->setPaymentMethod("paypal");
            $items = [];
            foreach ($_SESSION["ticketDetail"] as $ticket) {
                $item = new Item();
                $item->setName($ticket["name"])
                     ->setCurrency('USD')
                     ->setQuantity($ticket["totalQuantity"])
                     ->setSku($ticket["id"]) // Similar to `item_number` in Classic API
                     ->setPrice($ticket["price"]);
                $items[] = $item;
            }     
            $itemList = new ItemList();
            $itemList->setItems($items);
            $details = new Details();
            $details->setShipping(0)
                ->setTax($this->tax)
                ->setSubtotal($this->subtotal);
            $amount = new Amount();
            $amount->setCurrency("USD")
                ->setTotal($this->total)
                ->setDetails($details);
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(DOMAIN."/mywebsite.com/pay/executepayment/?success=true")
                         ->setCancelUrl(DOMAIN."/mywebsite.com/ticket");
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);
            $payment->create($this->apiContext);
            $approvedURL = $payment->getApprovalLink();
            header("Location: $approvedURL");  
    }
    public function executepayment(){   
       if (isset($_GET['success']) && $_GET['success'] == 'true') {
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);
        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();
        $details->setShipping(0)
                ->setTax($this->tax)
                ->setSubtotal($this->subtotal);
        $amount->setCurrency('USD');
        $amount->setTotal($this->total);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
        $execution->addTransaction($transaction);
        $result = $payment->execute($execution, $this->apiContext);
        $result = json_decode($result,true);
        if ($result["state"] === "approved") {
            $customer = new Customer;
            $saleTransaction = new SaleTransaction;
            $amusement = new Amusement;
            $ticketorder = new Ticketorder;
            if (!$customer->is_exist($result["payer"]["payer_info"]["email"])) {
                $customer->insert(["name"=>$result["payer"]["payer_info"]["first_name"].$result["payer"]["payer_info"]["last_name"],
                                    "phone"=>"0333691793",
                                     "email"=>$result["payer"]["payer_info"]["email"],
                                     "address"=>$result["payer"]["payer_info"]["shipping_address"]["line1"],
                                     "country"=>$result["payer"]["payer_info"]["shipping_address"]["country_code"]]);
                $insertedCustomer = $customer->getResult();
            } else {
                $insertedCustomer = $customer->getResult()[0]["id"];
            }
            $saleTransaction->insert(["customerId"=>$insertedCustomer,
                                     "amount"=>$this->total,
                                    "paid"=>1]);    
            
            $insertedTransact = $saleTransaction->getResult();
            foreach ($_SESSION["ticketDetail"] as $ticket) {
                $amusement->subtrackQuantity($ticket["id"], $ticket["totalQuantity"]);
                $ticketorder->insert(["amusementId"=>$ticket["id"],
                                    "customerId"=>$insertedCustomer,
                                    "transactionId"=>$insertedTransact,
                                    "childrenNum"=>$ticket["qc"],
                                    "adultNum"=>$ticket["qa"],
                                    "seniorNum"=>$ticket["qs"],
                                    "weekendDiscount"=>$ticket["wkDiscount"],
                                    "ageDiscount"=>$ticket["ageDiscount"],
                                    "totalQuantity"=>$ticket["totalQuantity"],
                                    "totalPrice"=>$ticket["totalPrice"],
                                    "ticketDate"=> date("Y-m-d",strtotime($ticket["date"]))]);
            }
            unset($_SESSION["ticketDetail"]);
            unset($_SESSION["sumOfTicket"]);
            unset($_SESSION["ticket"]);
            $_SESSION["ticketError"] = "Transaction complete! Thank you for using our service <3";
            header("Location: /mywebsite.com/ticket");
        } 
        else {
           $_SESSION["ticketError"] = "Transaction failed! please try again";
           header("Location: /mywebsite.com/ticket");
        }
      }
     
    }
}
