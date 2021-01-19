<?php

require_once "./../lib/config.php";

validate_empty_fields($post);

$at = date('Y-m-d H:i:s');

try {
    // dd($tracking);
    $sql = " UPDATE deliveries SET deleted_at = '$at' WHERE tracking_id = '$tracking' ";
    $link->query($sql);
    // dd($link->error);
} catch ( Exception $e ) {
    // 
}

$_SESSION['success'] = ['Delivery Info Deleted'];
on_success('deliveries');