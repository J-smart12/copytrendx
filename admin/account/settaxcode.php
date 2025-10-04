<?php 
    $page_title = "Generate Codes";
    include 'header.php';

    if(isset($_POST['submit'])) {
        $userid = strip_tags($_POST['userid']);
        $action = $admin->updateTaxCode($userid);
        if($action) {
            echo '
                <script>
                    window.location = "settaxcode.php?s=true";
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
                <h3>Set Codes</small></h3>
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
                                <th>Userid</th>
                                <th>COT code</th>
                                <th>IMF code</th>
                                <th>HAR code</th>
                                <th>TAX code</th>
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
                                        <td>'.$client['cot_code'].'</td>
                                        <td>'.$client['imf_code'].'</td>
                                        <td>'.$client['har_code'].'</td>
                                        <td>'.$client['otp'].'</td>
                                        <td>
                                            <form class="d-flex" method="POST" action="./settaxcode.php">
                                                <div>
                                                    <input type="hidden" name="userid" value="'.$client['userid'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Generate" class="btn btn-success">
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

