<?php
class Customer extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->table = "customer";
        $this->fields = ["name","phone","email","address","country"];
    }
    public function is_exist($email) 
    {
       $this->sql = "SELECT * FROM $this->table WHERE email = :email";
       $this->query($this->sql,[":email"=>$email]);
       if ($this->getResult() === "No results found") return false;
       else return true;
    }
}
