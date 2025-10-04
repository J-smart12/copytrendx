<?php 
    $page_title = "Balance";
    include 'header.php';

    if(isset($_POST['submit'])) {
        $userid = strip_tags($_POST['userid']);
        $val = strip_tags($_POST['amount']);
        $action = $admin->updateBalance($userid,$val);
        if($action) {
            echo '
                <script>
                    window.location = "top_up.php?s=true";
                </script>;
            ';
        }
    }
?>

<div class="right_col" role="main">
    <?php 
        if(isset($_GET['s']) == 'true') {
            echo '
                <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Update Success!</strong> New value has been added.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Deposited</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>userid</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($clients as $client) {
                                    echo '
                                    <tr>
                                        <th scope="row">'.$client['id'].'</th>
                                        <td>'.$client['fullname'].'</td>
                                        <td>'.$client['email'].'</td>
                                        <td>'.$client['userid'].'</td>
                                        <td>$'.number_format($client['balance']).'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./top_up.php">
                                                <div>
                                                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" style="width:80px;color:#151617;" required>
                                                    <input type="hidden" name="userid" value="'.$client['userid'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Add" class="btn btn-success">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

</div>
<?php 
    include 'footer.php';
?>

