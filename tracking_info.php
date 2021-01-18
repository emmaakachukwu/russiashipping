<?php

$title = "Tracking Info";
require_once "./components/header.php";

if ( !isset($_SESSION['tracking_id']) || empty($_SESSION['tracking_id']) )
    exit;
else
    $tracking_id = $_SESSION['tracking_id'];

$sql = "SELECT * FROM deliveries WHERE tracking_id = '$tracking_id' AND deleted_at IS NULL ORDER BY created_at ASC";
$result = $link->query($sql);
$tracks = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($tracks, $res);
} else {
    exit;
}

?>

<main>

    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <h3 class="mb-30">Tracking Information</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-defination">
                            <h4 class="mb-20">Tracking ID</h4>
                            <p><?php echo $tracks[0]->tracking_id ?></p>
                        </div>
                    </div>
                    <?php if ( $tracks[0]->name ) { ?>
                        <div class="col-md-4">
                            <div class="single-defination">
                                <h4 class="mb-20">Reciever's Name</h4>
                                <p><?php echo $tracks[0]->name ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ( $tracks[0]->phone ) { ?>
                        <div class="col-md-4">
                            <div class="single-defination">
                                <h4 class="mb-20">Reciever's Contact Number</h4>
                                <p><?php echo $tracks[0]->phone ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-4">
                        <div class="single-defination">
                            <h4 class="mb-20">Departure Address</h4>
                            <p><?php echo $tracks[0]->departure_address ?? 'not available' ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-defination">
                            <h4 class="mb-20">Destination Address</h4>
                            <p><?php echo $tracks[0]->destination ?? 'not available' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-top-border">
                <h3 class="mb-30">History</h3>
                <div class="progress-table-wrap">
                    <div class="progress-table">
                        <div class="table-head">
                            <div class="serial">#</div>
                            <div class="country">Date</div>
                            <div class="visit">Location</div>
                            <div class="percentage">Status</div>
                        </div>
                        <?php foreach ($tracks as $key => $track) { ?>
                            <div class="table-row">
                                <div class="serial"><?php echo $key+1 ?></div>
                                <div class="country"><?php echo date('d M, Y; h:i a', strtotime($track->created_at)) ?></div>
                                <div class="visit"><?php echo $track->location ?></div>
                                <div class="percentage"><?php echo $track->status ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require_once "./components/footer.php";