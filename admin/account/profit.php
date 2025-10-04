<?php 
    $page_title = "Add Profit";
    include 'header.php';

    if(isset($_POST['submit'])) {
        $userid = $_POST['userid'];
        $val = $_POST['amount'];
        $action = $admin->updateProfit($userid,$val);
        if($action) {
            echo '
                <script>
                    window.location = "profit.php?s=true";
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
                <h3>Add Profit</small></h3>
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>userid</th>
                                <th>Profit</th>
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
                                        <td>$'.$client['profit'].'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./profit.php">
                                                <div>
                                                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" style="min-width:80px;color#151617;" required>
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

