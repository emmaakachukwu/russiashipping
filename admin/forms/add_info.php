<?php

require_once "./../lib/config.php";

if ( !isset($_GET['tracking_id']) || empty(trim($_GET['tracking_id'])) ) {
    array_push($errors, 'Something went wrong.. please refresh');
    check_errors($errors);
} else {
    $tracking_id = $_GET['tracking_id'];
}

validate_empty_fields($post);

$sql = "SELECT * FROM deliveries WHERE `tracking_id` = '$tracking_id' AND deleted_at IS NULL LIMIT 1";
$result = $link->query($sql);
if ( $result->num_rows )
    $track = $result->fetch_object();

$at = date('Y-m-d H:i:s');
$sql = $link->prepare("INSERT INTO `deliveries` (`tracking_id`, `location`, `status`, `destination`, departure_address, created_at) VALUES (?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssss", $tracking_id, $location, $status, $destination, $track->departure_address, $at);
if ( $sql->execute() ) {
    $sql->close();
    $_SESSION['success'] = ['Delivery Info Added'];
    on_success('add_info');
}
$sql->close();

array_push($errors, 'Something went wrong; retry.. '.$link->error);

check_errors($errors);