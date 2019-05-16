<?php
class Contact extends Model {
    public function __construct(){
        parent::__construct();
        $this->table = "contact";
        $this->fields = ["name","email","phone","message"];
    }
}
