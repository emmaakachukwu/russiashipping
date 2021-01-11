<?php

include "./../lib/config.php";

if ( !isset($post['payment_id']) || empty(trim($post['payment_id'])) || !isset($post['approved']) || empty(trim($post['approved'])) || !is_numeric($post['payment_id']) )
    array_push($errors, 'something went wrong.. refresh');
else {
    $pid = $post['payment_id'];
    $approved = $post['approved'];
}

if ( $approved == 'true' )
    $approved = true;
else if ( $approved == 'false' )
    $approved = false;
else
    array_push($errors, 'something went wrong.. refresh');

check_errors($errors);

$at = date('Y-m-d H:i:s');
$approved_at = $approved ? null : $at;
$sql = $link->prepare("UPDATE `payments` SET `approved_at`=?, `updated_at`=? WHERE id=?");
$sql->bind_param("ssi", $approved_at, $at, $pid);
if ( $sql->execute() ) {
    $_SESSION['success'] = $approved ? ["Payment UnApproved"] : ['Payment Approved'];
    $sql->close();
    on_success('payments');
}

array_push($errors, 'Something went wrong; retry.. '.$link->error);

check_errors($errors);