<?php

if (isset($_GET['logout'])   &&  $_GET['logout'] === "true") {
    include_once __DIR__ . "/../classes/Login.php";
  if (!empty($_GET['logout'])) {
     $logout = new Login();
    $logout->logout("location: /music_industry/admin/");
  }
}


?>