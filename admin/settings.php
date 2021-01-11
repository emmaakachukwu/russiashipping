<?php

$title = 'Settings';
require_once "./lib/nav.php";

?>

<div class="page-header">
    <?php $heading = trim(explode('|', $title)[0]) ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><?php echo $heading ?? '' ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row pd-20 height-100-p mb-30">
    <div class="col-md-6 p-2">
        <div class="card-box p-4">
            <form action='./forms/settings.php' method='POST'>
                <h4 class="mb-30">Update Password</h4>
                <input type="hidden" name='tab' value='password'>
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" placeholder="Current Password" name='current_password' required>
                </div>
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" placeholder="New Password" name='new_password' required>
                </div>
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name='confirm_password' required>
                </div>

                <input type='submit' class="btn btn-primary btn-lg btn-block" value='Update Password'>
            </form>
        </div>
    </div>
</div>


<?php include_once "./lib/auth_footer.php";
