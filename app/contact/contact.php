<?php 
header("Content-Type: application/json");
include_once "../../classes/DBConnection.php";
$_db = new DBConnection();
$_conn = $_db->conn;

 if ($_SERVER['REQUEST_METHOD'] === "POST") {
     
     $fulllname = trim($_POST['fullname']);
     $email = trim(($_POST['email']));
     $telephone = trim($_POST['telephone']);
     $content = trim($_POST['content']);


  // validate input's
  if (empty($fulllname) || empty($email) || empty($telephone)) {
    http_response_code(400);
    exit(json_encode(["status" => "error", "message" => "please fill all field" ]));
  }

  if (!filter_var($email , FILTER_VALIDATE_EMAIL) ) {
      http_response_code(400);
      exit(json_encode(["status" => "error" , "message" => "invalid Email"]));  
    }
      
    $sql = "INSERT INTO contact_us(name, email, telephone, content) VALUES(?, ?, ?, ? )";
    $stmt = $_conn->prepare($sql);

    $stmt->bind_param("ssss", $fulllname, $email, $telephone, $content);
    
    if($stmt->execute()) {
    http_response_code(200);
    exit(json_encode(["status" => "success", "message" => "thanks for contacting us."]));
    }



}