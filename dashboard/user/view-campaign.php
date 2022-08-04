<?php

require('../../db.php');
$campaign_id = $_GET['id'];
$user_id = $_GET['user_id'];
$sql = "SELECT * FROM campaign WHERE campaign_id=$campaign_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$user_info_sql = "SELECT * FROM users WHERE user_id=$user_id";
$user_info_res = mysqli_query($conn, $user_info_sql);
$user_info_row = mysqli_fetch_assoc($user_info_res);

?>
<br>
<h4>View Campaign</h4>
<br>
<div class="jumbotron">
    <img src="<?php echo $row['image_url']; ?>" class="img-responsive w-100" alt="">
    <h1 class="display-3"><?php echo $row['campaign_name']; ?></h1>
    <p class="lead"><?php echo $row['description']; ?></p>
    <hr class="my-3">
    <p class="lead"><?php echo '₹'.$row['received'].'/'.'₹'.$row['total'] ; ?></p>
    <div class="progress mb-4 bg-dark">
    <div class="progress-bar progress-bar-striped active bg-success" role="progressbar"
        aria-valuenow="<?php echo $row['received']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $row['total']; ?>" style="width:<?php echo (($row['received']/$row['total'])*100) ?>%">
            <?php echo (($row['received']/$row['total'])*100) ?>%
        </div>
    </div>
    <p class="lead">
        <button class="btn btn-warning btn-lg" role="button" data-toggle="modal" data-target="#modelId">Donate Now</button>
    </p>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h4>Thank You for clicking donate button</h4>
                    <!-- current balance -->
                    <h5>Current Balance: <?php echo $user_info_row['balance']; ?></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <form onsubmit="(e) => e.preventDefault()">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                                </div>
                                <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $row['campaign_id']; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onClick="donateMoney()">Donate</button>
            </div>
        </div>
    </div>
</div>

<script>
    function donateMoney() {
        var amount = document.getElementById('amount').value;
        var campaign_id = document.getElementById('campaign_id').value;
        var user_id = <?php echo $user_id; ?>;
        $.ajax({
            url: './handler/donate.php',
            type: 'POST',
            data: {
                amount: amount,
                campaign_id: campaign_id,
                user_id: user_id
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response){
                console.log(response);
            }
        })
    }
</script>