<?php 
    $page_title = "Delete Account";
    include 'header.php';

    $clients = $admin->getClients();

    if(isset($_POST['submit'])) {
        $userid = filter_var($_POST['userid'], FILTER_SANITIZE_STRING);

        $action = $admin->DeleteUser($userid);
        
        if($action) {
            echo '
                <script>
                    window.location = "./delete.php?s=true";
                </script>;
            ';
        }else{
            echo '
                <script>
                    window.location = "./delete.php";
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
                    <strong>Delete Success!</strong> Client account has been deleted.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Delete Account</small></h3>
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
                                <th>email</th>
                                <th>Username</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                foreach($clients as $client) {
                                    $uid = $client['id'];
                                    echo '
                                    <tr id="'.$uid.'">
                                        <th scope="row">'.$client['id'].'</th>
                                        <td>'.$client['fullname'].'</td>
                                        <td>'.$client['email'].'</td>
                                        <td>'.$client['userid'].'</td>
                                        <td>$'.number_format($client['balance']).'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./delete.php">
                                                <input type="hidden" name="userid" value="'.$uid.'" required>
                                                <button type="submit" name="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
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

