<?php
// public/index.php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Helpers/security.php';
require_once __DIR__ . '/../src/Helpers/settings.php';

// Simple Router
$request = $_SERVER['REQUEST_URI'];
$base_path = '/PHP/Projects/Restaurant-Ordering-System/public'; // Adjust depending on server setup
$request = str_replace($base_path, '', $request);
$request = explode('?', $request)[0];

// Basic Routing Logic
switch ($request) {
    case '/':
    case '':
        require_once __DIR__ . '/../views/home.php';
        break;
    
    case '/login':
        require_once __DIR__ . '/../views/auth/login.php';
        break;

    case '/register':
        require_once __DIR__ . '/../views/auth/register.php';
        break;

    case '/forgot-password':
        require_once __DIR__ . '/../views/auth/forgot_password.php';
        break;

    case '/reset-password':
        require_once __DIR__ . '/../views/auth/reset_password.php';
        break;

    case '/profile':
        require_once __DIR__ . '/../views/profile.php';
        break;

    case '/orders':
        require_once __DIR__ . '/../views/orders.php';
        break;

    case '/orders/details':
        require_once __DIR__ . '/../views/order_details.php';
        break;

    case '/logout':
        session_destroy();
        header('Location: ./login');
        break;

    case '/admin':
        require_once __DIR__ . '/../views/admin/dashboard.php';
        break;

    case '/admin/products':
        require_once __DIR__ . '/../views/admin/products/index.php';
        break;

    case '/admin/products/create':
    case '/admin/products/edit':
        require_once __DIR__ . '/../views/admin/products/form.php';
        break;

    case '/admin/products/delete':
        require_once __DIR__ . '/../views/admin/products/delete.php';
        break;

    case '/admin/categories':
        require_once __DIR__ . '/../views/admin/categories/index.php';
        break;

    case '/admin/categories/create':
    case '/admin/categories/edit':
        require_once __DIR__ . '/../views/admin/categories/form.php';
        break;

    case '/admin/categories/delete':
        require_once __DIR__ . '/../views/admin/categories/delete.php';
        break;

    case '/admin/users':
        require_once __DIR__ . '/../views/admin/users.php';
        break;

    case '/admin/users/create':
    case '/admin/users/edit':
        require_once __DIR__ . '/../views/admin/users_form.php';
        break;

    case '/admin/users/delete':
        require_once __DIR__ . '/../views/admin/users_delete.php';
        break;

    case '/admin/orders':
        require_once __DIR__ . '/../views/admin/orders.php';
        break;

    case '/admin/orders/status':
        require_once __DIR__ . '/../views/admin/orders_status.php';
        break;

    case '/admin/settings':
        require_once __DIR__ . '/../views/admin/settings.php';
        break;

    case '/products':
        require_once __DIR__ . '/../views/products.php';
        break;

    case '/cart':
        require_once __DIR__ . '/../views/cart.php';
        break;

    case '/cart/add':
        require_once __DIR__ . '/../src/Helpers/cart_actions.php';
        break;

    case '/checkout':
        require_once __DIR__ . '/../views/checkout.php';
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/../views/404.php';
        break;
}
