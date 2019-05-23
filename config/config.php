<?php
    // path constants
    define("DS",DIRECTORY_SEPARATOR);
    define("ROOT", dirname(__DIR__) . DS);
    define("APP", ROOT . "app" . DS);
    define("CONFIG", ROOT . "config". DS);
    define("CORE", ROOT . "core" . DS);
    define("CONTROLLER", APP . "controller". DS);
    define("VIEW", APP . "view" . DS);
    define("MODEL", APP . "model" . DS);
    define("LIB", APP . "library" . DS);
    define("HELPERS", LIB . "helpers" . DS);
    define("VENDOR", ROOT . "vendor" . DS);
    // domain name
    define("DOMAIN","http://localhost:81");
    // default request constants
    define("DEFAULT_CONTROLLER", "homeController");
    define("DEFAULT_ACTION", "index");
    define("SITE_TITLE", "My website");
    // database constants
    define("SERVERNAME","localhost");
    define("DBNAME","accounts");
    define("DBUSERNAME","root");
    define("DBPASS","");
    define("DBCHARSET","utf8mb4");
    // pagination settings
    define("resultPerPage",3);
    define("amusementPerLoad",12);
    // discount values
    define("WEEKEND_DISCOUNT",10);
    define("CHILDREN_DISCOUNT",5);
    define("SENIOR_DISCOUNT",10);
    // paypal constants
    define("CLIENT_ID","AYKkQGoDZStizPeodCEBJ4Aa0gEmSzrgxvZspCOsGYO_dMdQWAIYqKST1msW1ViPu7ekuQoP7b_0fRFG");
    define("CLIENT_SECRET","EMT3te3Ee3XLJgok4EP58B60QNRTK3kLz4zVjN7DWDMS6gFHpgZ_8fjl7abwNGaJnlI82JHLzDCukbgP");
    $modules = [ROOT,CONFIG,CONTROLLER,VIEW,MODEL,CORE,LIB,HELPERS];
    set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
    spl_autoload_register("spl_autoload");

  