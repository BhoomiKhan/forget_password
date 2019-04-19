<?php
$conn = new mysqli("localhost", "username", "password", "db_name");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!isset($_POST['user_type'])) {
    die("user_type  is not set");
}
$user_type=$_POST['user_type'];

if(!isset($_POST['user_email'])) {
    die("user_email  is not set");
}
$user_email=$_POST['user_email'];

if(!isset($_POST['password_recovery_code'])) {
    die("password_recovery_code  is not set");
}
$password_recovery_code=$_POST['password_recovery_code'];

if($user_type=="learner") {
    $checkUser="SELECT lear_code FROM learner where lear_email='$user_email' AND lear_code='$password_recovery_code' ";
} else if($user_type=="instructor") {
    $checkUser="SELECT ins_code FROM instructor WHERE ins_email='$user_email' AND ins_code='$password_recovery_code' ";
} else {
    die("user type is invalid");
}

$result = $conn->query($checkUser);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if ($result->num_rows>0) {
echo "valid";
} else {
    echo "invalid";
}

?>