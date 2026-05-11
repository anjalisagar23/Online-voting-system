<?php
include 'connection.php';

session_start();

$regno = $_POST['register_number'];
$password = $_POST['password'];

if($con->connect_error){
    die("Failed to connect :" .$con->connect_error);
}

$stmt = $con->prepare("SELECT * FROM info WHERE regno = ?");
$stmt->bind_param("i", $regno);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $data = $result->fetch_assoc();

    $_SESSION['register_number'] = $regno;
    $_SESSION['department'] = $data['department'];

    // 👉 password check
    if(password_verify($password, $data['password'])){

        if($data['voters'] !== 'yes'){
            header("Location: 6_3voting.php");
            exit();
        } else {
            echo "<script>
                alert('Already voted');
                window.location.href='6_1login.php';
            </script>";
        }

    } else {
        echo "<script>
            alert('Wrong password');
            window.location.href='6_1login.php';
        </script>";
    }

} else {
    echo "<script>
        alert('User not found');
        window.location.href='6_1login.php';
    </script>";
}
?>