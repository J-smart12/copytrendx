<?php
    $page_title = "Lock Account";
    include 'header.php';
    
    if(isset($_POST['lock'])) {
        $id = $_POST['id'];
        $action = $admin->lockAccount($id);
        if($action) {
            echo '
                <script>
                    window.location = "lockaccount.php?s=true";
                </script>;
            ';
        }
    }
    if(isset($_POST['unlock'])) {
        $id = $_POST['id'];
        $action = $admin->UnlockAccount($id);
        if($action) {
            echo '
                <script>
                    window.location = "lockaccount.php?v=true";
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
                    <strong>Account Locked!</strong>.
                </div>
            ';
        }
    ?>
    
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Lock Account</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content table-responsive table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($clients as $client) {
                                    $locked = ($client['locked'] == "1") ? "disabled" : null;
                                    $unlocked = ($client['locked'] == "0") ? "disabled" : null;
                                    
                                    echo '
                                    <tr>
                                        <th scope="row">'.$client['id'].'</th>
                                        <td>'.$client['fullname'].'</td>
                                        <td>'.$client['email'].'</td>
                                        <td>'.$client['username'].'</td>
                                        <td>$'.number_format($client['balance']).'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./lockaccount.php">
                                                <div>
                                                    <input type="hidden" name="id" value="'.$client['username'].'" required>
                                                </div>
                                                <div>
                                                    <button type="submit" name="lock" class="btn btn-success" '.$locked.'> <i class="fa fa-lock"></i> </button>
                                                </div>
                                                <div> 
                                                    <button type="submit" name="unlock" class="btn btn-danger" '.$unlocked.'> <i class="fa fa-unlock"></i> </button>
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

