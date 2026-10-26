<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("UPDATE appointments SET status = 'Cancelled' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: staff_appointments.php");
exit();
