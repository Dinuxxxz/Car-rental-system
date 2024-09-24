<?php
require '../dbconfig.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->execute([$id]);

    echo "Staff member deleted successfully!";
}