<?php
class Amusement extends Model {
    public function __construct(){
        parent::__construct();
        $this->table = "amusement";
        $this->fields = ["name","description","height"];
    }
    public function getName($query){
        $this->sql = "SELECT name FROM $this->table WHERE name LIKE :query LIMIT 10";
        $this->query($this->sql,[":query"=>"%$query%"]);
    }
    public function getDetail($urlName) {
        $this->sql = "SELECT * FROM $this->table WHERE urlName = :urlName ";
        $this->query($this->sql,[":urlName"=>$urlName]);
    }
    public function getAmusement($offset,$where = "",$whereParam = []){
        $this->getLimit($offset,amusementPerLoad,$where,$whereParam);
    }
}
