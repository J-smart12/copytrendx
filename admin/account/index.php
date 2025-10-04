<?php 
    include 'header.php';
?>

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel tile ">
                    <div class="x_title">
                        <h2>Clients</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li>
                                <a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Userid</th>
                                        <th>Balance</th>
                                        <th>Phone</th>
                                        <th>Profit</th>
                                        <th>Country</th>
                                        <th>Referer</th>
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
                                                <td>$'.$client['balance'].'</td>
                                                <td>'.$client['phone'].'</td>
                                                <td>'.$client['profit'].'</td>
                                                <td>'.$client['country'].'</td>
                                                <td>'.$client['referal'].'</td>
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
</div>

</div>
<?php 
    include 'footer.php';
?>