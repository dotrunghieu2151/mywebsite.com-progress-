<?php 
    require "../config/config.php";
    session_start();
    AuthenToken::authenRemember();
    new Router;
