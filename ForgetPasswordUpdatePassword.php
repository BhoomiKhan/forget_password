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

if(!isset($_POST['new_password'])) {
    die("new_password  is not set");
}
$new_password=$_POST['new_password'];

if($user_type=="learner"){
    $checkUser="UPDATE learner SET lear_password='$new_password' WHERE lear_email='$user_email' ";
} else if($user_type=="instructor"){
    $checkUser="UPDATE instructor SET ins_password='$new_password' WHERE ins_email='$user_email' ";
} else {
    die("user type is invalid");
}

$result = $conn->query($checkUser);
if (!$result) {
    echo trigger_error('Invalid query: ' . $conn->error);
}
if ($result) {
    echo "updated";
} else {
    echo "fail";
}

?>