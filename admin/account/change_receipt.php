<?php 
    $page_title = "Change Receipt";
    include 'header.php';

    if(isset($_POST['submit'])) {
        $username = strip_tags($_POST['username']);
        $val = strip_tags($_POST['receipt']);
        $action = $admin->updateReceipt($username,$val);
        if($action) {
            echo '
                <script>
                    window.location = "change_receipt.php?s=true";
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
                <h3>Change Receipt</small></h3>
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
                                <th>Receipt</th>
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
                                        <td>'.$client['username'].'</td>';
                                        if($client['with_receipt'] == 0) {
                                            echo '<td style="color:red;">Pending</td>';
                                        }else{
                                            echo '<td style="color:green;">Successful</td>';
                                        }
                                        
                                    echo'<td>
                                            <form class="d-flex" method="POST" action="./change_receipt.php">
                                                <div>
                                                    <select name="receipt" id="" class="form-control">
                                                        <!--<option selected>'.(($client['with_receipt'] == 0)?"Pending":"Successful").'</option>-->
                                                        <option value="0">Pending</option>
                                                        <option value="1">Successful</option>
                                                    </select>
                                                    <input type="hidden" name="username" value="'.$client['username'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Change" class="btn btn-success">
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

