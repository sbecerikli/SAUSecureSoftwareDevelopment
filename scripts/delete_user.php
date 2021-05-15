<?php
session_start();
include_once 'token.php';


if (isset($_GET['login'], $_GET['token'])) {
    
    if (Token::check($_GET['token'])) {
        
        require 'config.php';
       
        $userId = !empty($_GET['userId']) ? trim(strip_tags($_GET['userId'])) : 0;

        echo $userId;
    }
}
