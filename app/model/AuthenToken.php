<?php
class AuthenToken extends Model {
    public function __construct() {
        parent::__construct();
        $this->table = "token";
        $this->fields = ["accountEmail","selector","validator","expire"];
    }
    public static function setToken($expire = 1800){
         $selector = bin2hex(random_bytes(8));
         $token = random_bytes(32);
         $validator = bin2hex($token);
         $expireDate = date("U") + $expire;
         $hashedToken = password_hash($token,PASSWORD_DEFAULT,["cost"=>11]);
         return ["selector"=>$selector,
                 "validator"=>$validator,
                 "hashedToken"=>$hashedToken,
                 "expire"=>$expireDate];
     }
     public function insertToken($email,$token){
         $this->insert(["accountEmail"=>$email,
                       "selector"=>$token["selector"],
                       "validator"=>$token["hashedToken"],
                       "expire"=>$token["expire"]]);
     }
    public function checkToken($selector,$validator){
        $currentDate = date("U");
        $this->sql = "SELECT * FROM $this->table WHERE selector= :selector AND expire >= $currentDate";
        $this->query($this->sql,[":selector"=>$selector]);
        if ($this->getResult() === "No results found") {return false;}
        $token = hex2bin($validator);
        if(!password_verify($token, $this->getResult()[0]["validator"])) {return false;}
        return true;
    }
    public function deleteTokenByEmail($email){
        $this->delete("WHERE accountEmail = :email",[":email"=>$email]);
    }
    public function deleteTokenBySelector($selector){
        $this->delete("WHERE selector = :selector",[":selector"=>$selector]);
    }
    public static function authenRemember(){
        If (empty($_SESSION["user"]) && isset($_COOKIE["remember"])) {
            list($selector,$validator) = explode(":",$_COOKIE["remember"]);
            $tokenAuthen = new AuthenToken;
            if ($tokenAuthen->checkToken($selector, $validator)){
                $userEmail = $tokenAuthen->getResult()[0]["accountEmail"];
                $userAuthen = new AuthenUser("","",$userEmail);
                $userAuthen->getUser();
                $result = $userAuthen->getResult();
                $_SESSION["user"] = ["id"=>$result[0]["id"],"username"=>$result[0]["user_name"]];
                // reset token
                $tokenAuthen->deleteTokenBySelector($selector);
                $newToken = AuthenToken::setToken(2592000);
                setCookie("remember",
                          $newToken["selector"].":".$newToken["validator"],
                          time() + 2592000,
                          '/',false);
                $tokenAuthen->insertToken($userEmail, $newToken);
            }
        }
    }
}
