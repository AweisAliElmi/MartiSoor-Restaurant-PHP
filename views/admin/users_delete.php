<?php
// views/admin/users_delete.php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../login');
    exit;
}

$id = $_GET['id'] ?? null;

// Prevent self-deletion
if ($id && $id != $_SESSION['user']['id']) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: /PHP/Projects/Restaurant-Ordering-System/public/admin/users');
exit;
