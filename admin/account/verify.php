<?php 
    $page_title = "Validate User";
    include 'header.php';
    
    if(isset($_POST['submit'])) {
        $userid = $_POST['userid'];
        $action = $admin->ValidateUser($userid);
        if($action) {
            echo '
                <script>
                    window.location = "verify.php?s=true";
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
                    <strong>Account Validation Success!</strong> Client account has been verified.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validate User</small></h3>
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
                                <th>Userid</th>
                                <th>Front</th>
                                <th>Back</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($verClients as $client) {
                                    $pd = ($client['status'] == "2") ? "disabled" : null;
                                    echo '
                                    <tr>
                                        <th scope="row">'.$client['id'].'</th>
                                        <td>'.$client['userid'].'</td>
                                        <td>
                                            <img src="../../account/uploads/verification/'.$client['front'].'" alt="verify image" style="width:90px;height:80px;object-fit:cover;"/>
                                            <a href="../../account/uploads/verification/'.$client['front'].'" class="btn btn-primary text-center" target="_blank" download><i class="fa fa-download" </a>
                                        </td>
                                        <td>
                                            <img src="../../account/uploads/verification/'.$client['back'].'" alt="verify image" style="width:90px;height:80px;object-fit:cover;"/>
                                            <a href="../../account/uploads/verification/'.$client['back'].'" class="btn btn-primary text-center" target="_blank" download><i class="fa fa-download" </a>
                                        </td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./verify.php">
                                                <div>
                                                    <input type="hidden" name="userid" value="'.$client['userid'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Validate" class="btn btn-success" '.$pd.'>
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

