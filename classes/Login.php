<?php
require_once __DIR__ . '/../classes/DBConnection.php';

class Login extends DBConnection {

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    // Admin login
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();

            if ($admin) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_name'] = $admin['username'];
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'Invalid Credential'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Admin not found'];
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('admin/login.php');
    }
}
?>
