<?php 
    $page_title = "Make Transaction";
    include 'header.php';
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
                <h3>Transactions</small></h3>
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
                                <th>Username</th>
                                <th>Balance</th>
                                <th>Account Number</th>
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
                                        <td>'.$client['username'].'</td>
                                        <td>$'.$client['balance'].'</td>
                                        <td>'.$client['accountNumber'].'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./backdate.php">
                                                <div>
                                                    <input type="hidden" name="username" value="'.$client['username'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Continue" class="btn btn-success">
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

