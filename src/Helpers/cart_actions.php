<?php
// src/Helpers/cart_actions.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prevent admins from ordering
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        header('Location: /products');
        exit;
    }
    $product_id = $_POST['product_id'] ?? null;
    $action = $_POST['action'] ?? 'add';

    if ($product_id) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if ($action === 'add') {
            $pdo = get_db_connection();
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch();

            if ($product) {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } else {
                    $_SESSION['cart'][$product_id] = [
                        'id' => $product['id'],
                        'title' => $product['title'],
                        'price' => $product['price'],
                        'image' => $product['image'],
                        'quantity' => 1
                    ];
                }
                $_SESSION['flash_message'] = "Added to cart!";
            }
        } elseif ($action === 'remove') {
            unset($_SESSION['cart'][$product_id]);
        } elseif ($action === 'update') {
            $quantity = (int)($_POST['quantity'] ?? 1);
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
}

header('Location: ' . ($_SERVER['HTTP_REFERER'] ?: './cart'));
exit;
