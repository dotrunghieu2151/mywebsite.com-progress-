<?php
class Customer extends Model{
    public function __construct(){
        parent::__construct();
        $this->table = "customer";
        $this->fields = ["name","phone","email","address","country"];
    }
}
