<?php

require_once "./../lib/config.php";

validate_empty_fields($post);

$at = date('Y-m-d H:i:s');
$hash = md5($at . $destination . time());
$tracking = substr($hash, 0, 6) . substr($hash, -6, 6);
$status = "Shipment Created";
$sql = $link->prepare("INSERT INTO `deliveries` (`tracking_id`, `location`, `status`, `destination`, departure_address, created_at) VALUES (?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssss", $tracking, $departure, $status, $destination, $departure, $at);
if ( $sql->execute() ) {
    $sql->close();
    $_SESSION['success'] = ['Delivery added'];
    on_success('add_delivery');
}
$sql->close();

array_push($errors, 'Something went wrong; retry.. '.$link->error);

check_errors($errors);