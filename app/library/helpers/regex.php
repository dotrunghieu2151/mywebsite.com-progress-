<?php
class regex {
    public static function check_cc($cc) {
        $cards = [
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "(3[47]\d{13})",           
            "mastercard" => "(5[1-5]\d{14})"         
        ];
        $names = ["Visa", "American Express","Mastercard"];
        $matches = [];
        $pattern = "#^(?:".implode("|", $cards).")$#";
        $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
        return ($result>0) ? $names[sizeof($matches)-2] : false;
        // visa : 4111111111111111
        // master: 5555555555554444
        // amex: 378282246310005
    }
     public static function check_CVV($cvv) {
         return preg_match("/^[0-9]{3,4}$/",$cvv);
     }
     public static function check_phone($number){
        //UK Phone numbers are 10 or 11 digits long, and have a 3, 4, 5 or 6 digit area code
        $s = "(([ \-\.])*)?";
        $result = preg_match("#^((\(?\d{3}\)?$s\d{7,8})|(\(?\d{4}\)?$s\d{6,7})|(\(?\d{5}\)?$s\d{5,6})|(\(?\d{6}\)?$s\d{4,5}))$#", $number);
        return $result;
    }
}
