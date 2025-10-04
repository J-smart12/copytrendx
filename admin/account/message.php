<?php 
    $page_title = "Add New Coin";
    include 'header.php';

    $messages = $admin->newMessages();
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Activities</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Activities <small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <ul class="list-unstyled timeline widget">
                            <?php 
                                foreach($messages as $message) {
                                    $image = '../../account/uploads/paymentshots/'.$message['payment_proof'];
                                    echo '
                                    <li>
                                        <div class="block">
                                            <div class="block_content">
                                                <h2 class="title">
                                                    <a>'.$message['status'].'</a>
                                                </h2>
                                                <div class="byline">
                                                    <span>'.$message['createdAt'].'</span> by <a>'.$message['userid'].'</a>
                                                </div>
                                                <p class="excerpt">
                                                    '.$message['details'].' using '.$message['walletType'].' payment gateway
                                                </p>';?>
                                                
                                               
                                                    <p> <p>See payment proof</p>
                                                        <?php echo (($message['payment_proof'] != '') ? '
                                                            <img src="'.$image.'" class="img-fluid"  style="width:100%;height:50px;object-fit:cover;"/>
                                                        ' : NULL ); ?>
                                                    </p>
                                                
                                                <?php  
                                                echo '
                                            </div>
                                        </div>
                                    </li>
                                    ';
                                }
                            ?>
                            
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div>
<?php 
    include 'footer.php';
?>

