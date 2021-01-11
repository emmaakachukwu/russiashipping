<?php
$title = 'Deliveries';
require_once "./lib/nav.php";

$sql = "SELECT * FROM deliveries WHERE id IN (SELECT MAX(id) FROM deliveries GROUP BY tracking_id) AND deleted_at IS NULL ORDER BY created_at ASC";
$result = $link->query($sql);
$deliveries = [];
if ( $result->num_rows ) {
    while($res = $result->fetch_object())
        array_push($deliveries, $res);
}

function shorten_sring(string $var): string {
    return strlen($var) > 25 ? substr($var, 0, 25).'...' : $var;
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
    <a href="./add_delivery.php" class="btn btn-primary text-white mt-3"><i class="fa fa-plus"></i> &nbsp; Add Delivery</a>
</div>

<div class="card-box pd-20 height-100-p mb-30 table-responsive">
    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Tracking ID</th>
            <th scope="col">Date</th>
            <th scope="col">Location</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </thead>
        <?php if ( count($deliveries) ) { ?>
            <tbody>
                <?php for ( $i = 0; $i < count($deliveries); $i++ ) { ?>
                    <tr>
                        <td><?php echo  $i+1 ?></td>
                        <td><?php echo $deliveries[$i]->tracking_id ?></td>
                        <td><?php echo date('d M, Y h:i a', strtotime($deliveries[$i]->created_at)) ?? '' ?></td>
                        <td><?php echo $deliveries[$i]->location ?></td>
                        <td><?php echo $deliveries[$i]->status ?></td>
                        <td><button class="btn btn-primary">Update Info</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        <?php } ?>
    </table>					
</div>

<?php include_once "./lib/auth_footer.php" ?>

<script>
    const deleteProduct = (id) => {
        let form = document.querySelector('#form-'+id)
        if ( confirm("Delete Product?") )
            form.submit();
    }
</script>