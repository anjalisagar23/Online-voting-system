<?php
include 'connection.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($con->connect_error){
    die("Failed to connect :" .$con->connect_error);
}

$stmt = $con->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username); // ✅ FIX
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $data = $result->fetch_assoc();

    // 👉 password check
    if($data['password'] === $password){  // (agar plain text hai)
        
        $_SESSION['admin'] = $username; // ✅ FIX
        header("Location: admin_page.php");
        exit();

    } else {
        echo "<script>
            alert('Wrong password');
            window.location.href='Admin.php';
        </script>";
    }

} else {
    echo "<script>
        alert('Admin not found');
        window.location.href='Admin.php';
    </script>";
}
?>