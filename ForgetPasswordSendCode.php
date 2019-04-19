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

if($user_type=="learner") {
    $checkUser="SELECT lear_email from learner where lear_email='$user_email' ";
} else if($user_type=="instructor") {
    $checkUser="SELECT ins_email FROM instructor WHERE ins_email='$user_email' ";
} else {
    die("user type is invalid");
}

$result = $conn->query($checkUser);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if ($result->num_rows>0) {
    $six_digit_random_number = mt_rand(100000, 999999);
   if(mail($user_email,"Excel Drive, password reset",$six_digit_random_number." is your password recovery code")){
       if($user_type=="learner"){
            $checkUser="UPDATE learner SET lear_code='$six_digit_random_number' WHERE lear_email='$user_email' ";
        } else if($user_type=="instructor"){
            $checkUser="UPDATE instructor SET ins_code='$six_digit_random_number' WHERE ins_email='$user_email' ";
        }
        //it will execute the query
        $result = $conn->query($checkUser);
        if($result){
                echo "done";
            } else {
                echo "fail";
            }
   } else {
       echo "not sent";
   }
} else {
echo  die("email does not exist");
}
?>