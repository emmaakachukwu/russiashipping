<?php
$title = 'Settings';
require_once "./lib/nav.php";

$sql = "SELECT * FROM wallets";
$result = $link->query($sql);
$wallets = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($wallets, $res);
}

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
    <?php if ( count($wallets) ) { ?>
        <div class="col-md-6 p-2">
            <?php 
            foreach ($wallets as $wallet) {
                if ( $wallet->type == 'btc' ) {?>
                <div class="card-box p-4 mb-30">
                    <h4 class="mb-30">BITCOIN WALLET DETAILS</h4>
                    <form action='./forms/settings.php' method='POST'>
                        <input type="hidden" name='tab' value='<?php echo $wallet->type ?>'>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="BITCOIN ID" name='wid' value="<?php echo $wallet->wallet_id ?>" required>
                            <small>BITCOIN ID</small>
                        </div>
                        <input type='submit' class="btn btn-primary btn-lg btn-block" value='Update Wallet Info'>
                    </form>
                </div>
            <?php 
            } 
            if ( $wallet->type == 'native_lang' ) {
            ?>
            <div class="card-box p-4 mb-30">
                <h4 class="mb-30">BANK DETAILS (TRANSLATED)</h4>
                <form action='./forms/settings.php' method='POST'>
                    <input type="hidden" name='tab' value='<?php echo $wallet->type ?>'>
                    <div class="input-group custom d-block">
                        <input type="text" class="form-control form-control-lg" placeholder="Account number" name='wid' value="<?php echo $wallet->wallet_id ?>" required>
                        <small>Номер счета</small>
                    </div>
                    <div class="input-group custom d-block">
                        <input type="text" class="form-control form-control-lg" placeholder="Bank name" name='bname' value="<?php echo $wallet->bank_name ?>" required>
                        <small>Название банка</small>
                    </div>
                    <div class="input-group custom d-block">
                        <input type="text" class="form-control form-control-lg" placeholder="Bank address" name='baddress' value="<?php echo $wallet->bank_address ?>" required>
                        <small>Адрес банка</small>
                    </div>
                    <div class="input-group custom d-block">
                        <input type="text" class="form-control form-control-lg" placeholder="Recipient name" name='recipient' value="<?php echo $wallet->recipient_name ?>" required>
                        <small>Имя получателя</small>
                    </div>
                    <div class="input-group custom d-block">
                        <input type="text" class="form-control form-control-lg" placeholder="Swift code" name='swift' value="<?php echo $wallet->swift_code ?>" required>
                        <small>SWIFT-код</small>
                    </div>
                    <input type='submit' class="btn btn-primary btn-lg btn-block" value='Update Wallet Info'>
                </form>
            </div>
            <?php
            }
            if ( $wallet->type == 'bank' ) {
            ?>
                <div class="card-box p-4 mb-30">
                    <h4 class="mb-30">BANK DETAILS</h4>
                    <form action='./forms/settings.php' method='POST'>
                        <input type="hidden" name='tab' value='<?php echo $wallet->type ?>'>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="Account number" name='wid' value="<?php echo $wallet->wallet_id ?>" required>
                            <small>ACCOUNT NUMBER</small>
                        </div>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="Bank name" name='bname' value="<?php echo $wallet->bank_name ?>" required>
                            <small>BANK NAME</small>
                        </div>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="Bank address" name='baddress' value="<?php echo $wallet->bank_address ?>" required>
                            <small>BANK ADDRESS</small>
                        </div>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="Recipient name" name='recipient' value="<?php echo $wallet->recipient_name ?>" required>
                            <small>RECIPIENT NAME</small>
                        </div>
                        <div class="input-group custom d-block">
                            <input type="text" class="form-control form-control-lg" placeholder="Swift code" name='swift' value="<?php echo $wallet->swift_code ?>" required>
                            <small>SWIFT CODE</small>
                        </div>
                        <input type='submit' class="btn btn-primary btn-lg btn-block" value='Update Wallet Info'>
                    </form>
                </div>
            <?php } } ?>
        </div>
    <?php } ?>
    
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
