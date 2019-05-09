<?php
class AuthenUser extends Model{
    protected $username;
    protected $pass;
    protected $email;
    protected $pepper = "FA2DKJL45KANVM";
    public function __construct($username="",$password="",$email="") {
        parent::__construct();
        $this->username = $username;
        $this->pass = $password;
        $this->email = $email;
    }
     public function usernameExist(){
         $this->sql = "SELECT COUNT(*) as COUNT FROM users WHERE user_name = :username";
         $this->query($this->sql, [":username"=>$this->username]);
         if ($this->getResult()[0]["COUNT"] != 0) return true;
         else return false;
     }
     public function emailExist(){
         $this->sql = "SELECT COUNT(*) as COUNT FROM users WHERE email = :email";
         $this->query($this->sql, [":email"=>$this->email]);
         if ($this->getResult()[0]["COUNT"] != 0) return true;
         else return false;
     }
     public function getUser(){
         $this->sql = "SELECT * FROM users WHERE user_name = :username OR email = :email";
         $this->query($this->sql,[":username"=>$this->username,":email"=>$this->email]);
     }
     public function addUser(){
         $this->table = "users";
         $this->insert(["user_name"=>$this->username,"password"=>$this->hashPass(),"email"=>$this->email]);
     }
     public function hashPass(){
         return password_hash($this->pass.$this->pepper, PASSWORD_DEFAULT,["cost"=>11]);
     }
     public function checkPass($passFromDB){
         $this->table = "users";
         if (!password_verify($this->pass.$this->pepper, $passFromDB)) {return false;}
         if(password_needs_rehash($passFromDB,PASSWORD_DEFAULT,["cost"=>11])) {
             $this->pass= $this->hashPass();
             $this->update(["password"=> $this->pass],
                            "WHERE user_name = :username OR email = :email",
                            [":username"=> $this->username,":email"=> $this->email]);
         }
         return true;
     }
     public function setActiveAccount($email){
         $this->table = "users";
         $this->update(["active"=>1],
                       "WHERE email = :email",
                       [":email"=> $email]);
     }
     public static function setToken(){
         $selector = bin2hex(random_bytes(8));
         $token = random_bytes(32);
         $validator = bin2hex($token);
         $expireDate = date("U") + 1800;
         $hashedToken = password_hash($token,PASSWORD_DEFAULT,["cost"=>11]);
         return ["selector"=>$selector,
                 "validator"=>$validator,
                 "hashedToken"=>$hashedToken,
                 "expire"=>$expireDate];
     }
     public function insertToken($token){
         $this->deleteToken();
         $this->insert(["accountEmail"=>$this->email,
                       "selector"=>$token["selector"],
                       "validator"=>$token["hashedToken"],
                       "expire"=>$token["expire"]]);
     }
    public function checkToken($selector,$validator){
        $currentDate = date("U");
        $this->sql = "SELECT * FROM verifyaccount WHERE selector= :selector AND expire >= $currentDate";
        $this->query($this->sql,[":selector"=>$selector]);
        if (count($this->getResult()) === 0) {return false;}
        $token = hex2bin($validator);
        if(!password_verify($token, $this->getResult()[0]["validator"])) {return false;}
        return true;
    }
    public function deleteToken(){
        $this->table = "verifyaccount";
        $this->delete("WHERE accountEmail = :email",[":email"=>$this->email]);
    }
}
