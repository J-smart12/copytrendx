<?php
    $page_title = "Validate Deposit";
    include 'header.php';
    

    if(isset($_POST['Validate'])) {
        $tid = $_POST['tid'];
        $type = $_POST['type'];
        $action = $admin->validateTransaction($tid,$type);
        if($action) {
            echo '
                <script>
                    window.location = "validate.php?v=true";
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
                    <strong>Transaction Validation Success!</strong>.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Validate Transaction</small></h3>
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
                                <th>userid</th>
                                <th>Status</th>
                                <th>amount</th>
                                <th>Transaction Type</th>
                                <th>Pay Proof / Withraw Wallet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                
                                foreach($messages as $client) {
                                    $pd = ($client['status'] == 0) ? "disabled" : null;
                                    $ap = ($client['status'] == 1) ? "disabled" : null;
                                    echo '
                                    <tr>
                                        <th scope="row">'.$client['id'].'</th>
                                        <td>'.$client['userid'].'</td>';
                                        
                                        
                                        if($client['status'] == 0) {
                                            echo '<td style="color:red;">Pending</td>';
                                        }else{
                                            echo '<td style="color:green;">Approved</td>';
                                        }
                                        
                                        echo'<td>'.$client['amount'].'</td>
                                        <td>'.$client['type'].'</td>';
                                        
                                        if($client['type'] == "Deposit"){
                                            
                                            
                                            echo '
                                                <td>
                                                    <a href="../../../user/uploads/'.$client['proof'].'" class="btn btn-primary" target="_blank"><i class="fa fa-eye" </a>
                                                </td>
                                            ';
                                        }else{
                                             echo '
                                                <td>None</td>
                                            ';
                                        }
                                        
                                        echo'<td>
                                            <form class="d-flex" method="POST" action="./validate.php">
                                                <div>
                                                    <input type="hidden" name="tid" value="'.$client['id'].'" required>
                                                    <input type="hidden" name="type" value="'.(($client['type'] == "Withdraw")?2:1).'" required>
                                                    
                                                </div>
                                                <div>
                                                    <input type="submit" name="Validate" value="Approve" class="btn btn-success" '.$ap.'>
                                                </div>
                                                <div>
                                                    <input type="submit" name="Cancell" value="Cancell" class="btn btn-danger" '.$pd.'>
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

