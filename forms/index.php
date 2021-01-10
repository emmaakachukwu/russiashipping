<?php

require_once "./../lib/config.php";

validate_empty_fields($post);

$sql = $link->prepare("SELECT tracking_id FROM deliveries WHERE tracking_id = ? AND deleted_at IS NULL LIMIT 1");
$sql->bind_param("s", $tracking);
if ( $sql->execute() ) {
    $sql->bind_result($_track);
    $sql->fetch();

    if ( $_track ) {
        $_SESSION['tracking_id'] = $_track;
        on_success('tracking_info');
    }
    array_push($errors, "Tracking ID not found");
    check_errors($errors);
}

array_push($errors, 'Something went wrong..');
check_errors($errors);