<?php
include ('../config/db.php');

$username = $_POST['username'];
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$address = $_POST['address'];
$contactNo = $_POST['contactNo'];


if($password == $confirmPassword){
    $hashed_password = password_hash($password,PASSWORD_BCRYPT);
    $sql = "INSERT INTO user (username,password,email,full_name,address,contact_no) values ('$username','$hashed_password','$email','$fullName','$address','$contactNo')";

    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:../../frontend/pages/user_login.php?status=200');
    }else{
        header('location:../../frontend/pages/user_login.php?status=500');
    }

}else{
    header('location:../../frontend/pages/user_login.php?status=500');
}


?>