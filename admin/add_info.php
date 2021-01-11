<?php

$title = 'Add Info';
require_once "./lib/nav.php";

$tracking_id = isset($_GET['tracking_id']) ? trim($_GET['tracking_id']) : null;

if ( !$tracking_id || empty(trim($id)) ) {
    _404_error();
}

$sql = "SELECT * FROM deliveries WHERE tracking_id = '$tracking_id' AND deleted_at IS NULL LIMIT 1";
$result = $link->query($sql);
if ( !$result->num_rows ) {
    _404_error();
}
$track = $result->fetch_object();

function _404_error(): void {
    http_response_code(404);
    exit;
}

?>

<div class="page-header">
    <?php $heading = trim(explode('|', $title)[0]) ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><?php echo $heading ?? '' ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./deliveries.php">Deliveries</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $heading ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card-box pd-20 height-100-p mb-30">
    <form action='./forms/add_info.php?tracking_id=<?php echo $track->tracking_id ?>' method='POST'>
        <div class="row">
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Location" name='location' required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Status" name='status' required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input type='submit' class="btn btn-primary btn-lg btn-block" value='Add Tracking Info'>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_once "./lib/auth_footer.php";
