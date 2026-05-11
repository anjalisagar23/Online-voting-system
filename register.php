<?php

include 'student_details.php';
session_start();

$regno = $_POST['register_number'];
$username = $_POST['name'];
$email = $_POST['email'];
$semester = $_POST['semester'];
$department = $_POST['department'];
$password = $_POST['password'];
$cpassword = $_POST['confirm_password'];

// password match check
if($password !== $cpassword){
    echo '<script>
        alert("Password do not match");
        window.location.href="6_2register.php";
    </script>';
    exit();
}

// password hash
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// insert directly
$sql = "INSERT INTO info (regno, name, email, semester, department, password, voters)
VALUES ('$regno', '$username', '$email', '$semester', '$department', '$hashed_password', 'no')";

$result = mysqli_query($con, $sql);

if($result){
    echo '<script>
        alert("Registration Successful!");
        window.location.href="6_1login.php";
    </script>';
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>