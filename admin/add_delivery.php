<?php
$title = 'Add Delivery';
require_once "./lib/nav.php";

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
    <form action='./forms/add_delivery.php' method='POST'>
        <div class="row">
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Reciever's Name" name='name' required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Reciever's Phone" name='phone' required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Departure Address" name='departure_address' value="<?php echo session_val('departure_address') ?>" required>
            </div>
            <div class="input-group custom col-md-6">
                <input type="text" class="form-control form-control-lg" placeholder="Destination" name='destination' required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input type='submit' class="btn btn-primary btn-lg btn-block" value='Add Delivery'>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_once "./lib/auth_footer.php";
