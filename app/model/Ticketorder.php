<?php
class Ticketorder extends Model{
    public function __construct(){
        parent::__construct();
        $this->table = "ticketorder";
        $this->fields = ["amusementId","customerId","transactionId","childrenNum","adultNum","seniorNum","weekendDiscount",
           "ageDiscount","totalQuantity","totalPrice","ticketDate"];
    }
}
