<?php
include 'connection.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = 1;

$sql = "SELECT value FROM register WHERE id = $id";
$result = $con->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $currentValue = $row['value'];

    $newValue = ($currentValue === "yes") ? "no" : "yes";

    $updateSql = "UPDATE register SET value = '$newValue' WHERE id = $id";
    $con->query($updateSql);
}

// redirect (no echo before this)
header('Location: admin_page.php');
exit();
?>
