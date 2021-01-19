<?php

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `role` VARCHAR(50) NOT NULL DEFAULT 'user',
    `password` varchar(250) NOT NULL,
    `fname` varchar(100) DEFAULT NULL,
    `lname` varchar(100) DEFAULT NULL,
    `phone` varchar(20) DEFAULT NULL,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `deliveries` (
    `id` INT(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `tracking_id` VARCHAR(20) NOT NULL,
    `location` VARCHAR(250) NULL,
    `status` VARCHAR(250) NULL,
    `destination` varchar(250) NULL,
    `departure_address` VARCHAR(250) NULL,
    `deleted_at` TIMESTAMP NULL,

    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL
)";
$link->query($sql);

// $sql = "ALTER TABLE deliveries ADD `name` VARCHAR(100) NULL AFTER `tracking_id`, ADD `phone` VARCHAR(50) NULL AFTER `tracking_id`";
// $link->query($sql);

$admin_email = 'admin@russianshipping.com';
$admin_username = 'russianshippingadmin';
$uuid = md5($admin_email . $admin_username . '...');
$sql = "SELECT email FROM users WHERE email = '$admin_email' LIMIT 1";
$result = $link->query($sql);
if ( !$result->num_rows ) {
    $sql = "INSERT INTO users (username, email, fname, lname, password, role) VALUES ('$admin_username', '$admin_email', 'russian', 'shippping', 'russianshippingpass100', 'admin')";
    $link->query($sql);
}

// $sql = "SELECT id FROM deliveries WHERE deleted_at IS NULL LIMIT 1";
// $result = $link->query($sql);
// if ( !$result->num_rows ) {
//     for ($i = 0; $i < 3; $i++) {
//         $sql = "INSERT INTO deliveries (tracking_id, `location`, `status`, destination, `departure_address`) VALUES ('1349036865', 'Lagos', 'SHIPMENT CREATED', 'Nnamdi Azikiwe University, Along Enugu-Onitsha Expressway, Ifite Road, 420110, Awka, Nigeria', '3 Birrel Ave, 3 Birrel Ave, Yaba 100001, Lagos, Nigeria')";
//         $link->query($sql);
//     }
// }
