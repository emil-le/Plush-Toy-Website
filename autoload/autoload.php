<?php
    require_once __DIR__.("/../libraries/function.php");
    require_once __DIR__.("/../Model/My_Model.php");

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/corephp/admin/");
    define("IP",$_SERVER['REMOTE_ADDR']);

    $permissions = [
        'all' => 'Full Permission',
        'home' => 'Home',
        'list-order' => 'List order',
        'delete-order' => 'Delete order',
        'list-category' => 'List category',
        'add-category' => 'Add category',
        'edit-category' => 'Edit category',
        'delete-category' => 'Delete category',
        'list-products' => 'List products',
        'add-products' => 'Add products',
        'edit-products' => 'Edit products',
        'list-admin' => 'List admin',
        'add-admin' => 'Add admin',
        'edit-admin' => 'Add admin',
        'delete-admin' => 'Delete admin',
        'list-user' => 'List user',
        'edit-user' => 'Edit user',
        'delete-user' => 'Delete user',
        'list-news' => 'List news',
        'add-news' => 'Add news',
        'edit-news' => 'Edit news',
        'delete-news' => 'Delete news',
        'list-permission' => 'List permission',
        'add-permission' => 'Add permission',
        'edit-permission' => 'Edit permission',
        'delete-permission' => 'Delete permission',
    ]
?>