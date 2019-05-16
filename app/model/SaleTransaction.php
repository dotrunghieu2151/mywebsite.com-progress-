<?php
class SaleTransaction extends Model{
     public function __construct(){
        parent::__construct();
        $this->table = "saletransaction";
        $this->fields = ["customerId","amount","paid"];
    }
}
