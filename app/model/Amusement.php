<?php
class Amusement extends Model {
    public function __construct(){
        parent::__construct();
        $this->table = "amusement";
        $this->fields = ["name","description","height","price"];
    }
    public function getName($query){
        $this->sql = "SELECT name FROM $this->table WHERE name LIKE :query LIMIT 10";
        $this->query($this->sql,[":query"=>"$query%"]);
    }
    public function getAmusementById($idArray){
        $this->getByid($idArray);
    }  
    public function getDetail($urlName) {
        $this->sql = "SELECT * FROM $this->table WHERE urlName = :urlName ";
        $this->query($this->sql,[":urlName"=>$urlName]);
    }
    public function getAmusement($offset,$where = "",$whereParam = []){
        $this->getLimit($offset,amusementPerLoad,$where,$whereParam);
    }
    public function checkQuantity($id,$quantity){
        $this->sql = "SELECT quantity FROM amusement WHERE id = :id";
        $this->query($this->sql,[":id"=>$id]);
        if ($this->getResult()[0]["quantity"] < $quantity) return false;
        else return true;
    }
    public function subtrackQuantity($id,$quantity) {
        $this->sql = "UPDATE $this->table SET quantity = quantity - :quantity WHERE id = :id";
        $this->query($this->sql,[":quantity"=>$quantity,":id"=>$id],false);
    }
}
