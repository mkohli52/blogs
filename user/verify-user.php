<?php
header('Content-Type: application/json');
require '../database/db_connection.php';
$email = $_POST['email'];
$password = $_POST['password'];
$response = [];
$sql = "SELECT * FROM users  WHERE email ='" . $email . "' AND deleted_at IS NULL";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $verify = password_verify($password, $data['password']);
    if ($verify) {
        $response['status'] = true;
        $response['message'] = 'User Logged In Succesfully';
        $cookie_expire = time() + (30 * 24 * 60 * 60);
        setcookie("email",$email,$cookie_expire,"/");
    } else {
        $response['status'] = false;
        $response['message'] = 'Wrong email id or password';
    }
} else {
    $response['status'] = false;
    $response['message'] = 'User Not Found';
}

echo json_encode($response);

?>
