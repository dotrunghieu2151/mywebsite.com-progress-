<?php
class AuthenUser extends Model{
    protected $username;
    protected $pass;
    protected $email;
    protected $pepper = "FA2DKJL45KANVM";
    public function __construct($username="",$password="",$email="") {
        parent::__construct();
        $this->table = "users";
        $this->fields = ["user_name","email","password","active"];
        $this->username = $username;
        $this->pass = $password;
        $this->email = $email;
    }
     public function usernameExist(){
         $this->sql = "SELECT COUNT(*) as COUNT FROM $this->table WHERE user_name = :username";
         $this->query($this->sql, [":username"=>$this->username]);
         if ($this->getResult()[0]["COUNT"] != 0) return true;
         else return false;
     }
     public function emailExist(){
         $this->sql = "SELECT COUNT(*) as COUNT FROM $this->table WHERE email = :email";
         $this->query($this->sql, [":email"=>$this->email]);
         if ($this->getResult()[0]["COUNT"] != 0) return true;
         else return false;
     }
     public function getUser(){
         $this->sql = "SELECT * FROM $this->table WHERE user_name = :username OR email = :email";
         $this->query($this->sql,[":username"=>$this->username,":email"=>$this->email]);
     }
     public function addUser(){
         $this->insert(["user_name"=>$this->username,"password"=>$this->hashPass(),"email"=>$this->email]);
     }
     public function hashPass(){
         return password_hash($this->pass.$this->pepper, PASSWORD_DEFAULT,["cost"=>11]);
     }
     public function checkPass($passFromDB){
         if (!password_verify($this->pass.$this->pepper, $passFromDB)) {return false;}
         if(password_needs_rehash($passFromDB,PASSWORD_DEFAULT,["cost"=>11])) {
             $this->pass= $this->hashPass();
             $this->update(["password"=> $this->pass],
                            "WHERE user_name = :username OR email = :email",
                            [":username"=> $this->username,":email"=> $this->email]);
         }
         return true;
     }
     public function resetPass(){
         $this->update(["password"=>$this->hashPass()],"WHERE email = :email",[":email"=>$this->email]);
     }
     public function setActiveAccount(){
         $this->update(["active"=>1],
                       "WHERE email = :email",
                       [":email"=> $this->email]);
     }    
}
