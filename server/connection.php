<?php
session_start();
include_once ('../classes/DBConnection.php');
if(!defined('base_url')) define('base_url','/music_industry/');
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
if(!defined('DB_NAME')) define('DB_NAME',"geet");



$db = new DBConnection();
$conn = $db->conn;

// Global redirect helper
function redirect($url = '') {
    if (!empty($url)) {
        header("Location: $url");
        exit;
    }
}

?>