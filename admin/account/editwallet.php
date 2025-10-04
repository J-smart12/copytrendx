<?php 
    $page_title = "Change Wallet Address";
    include 'header.php';

    $coins = $admin->getCoins();

    if(isset($_POST['submit'])) {
        $coin = $_POST['coin'];
        $val = $_POST['wallet_address'];
        $wallet = $admin->updateCoin($coin,$val);
        if($wallet) {
            echo '
            <script>
                window.location = "./changewallet.php?s=true";
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
                    <strong>Update Success!</strong> New address has been added.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Wallet Address</small></h3>
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
                                <th>Coin</th>
                                <th>Wallet Address</th>
                                <th>Current Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($coins as $coin) {
                                    echo '
                                    <tr>
                                        <th scope="row">'.$coin["id"].'</th>
                                        <td>'.$coin["coin_type"].'</td>
                                        <td>'.$coin["wallet_address"].'</td>
                                        <td>'.$coin["current_price"].'</td>
                                        <td>
                                            <form class="d-flex" action="./changewallet.php" method="POST">
                                                <div>
                                                    <input type="text" name="wallet_address" class="form-control" placeholder="Enter New Wallet" style="min-width:120px;color:#151617;" required>
                                                    <input type="hidden" name="coin" value="'.$coin['coin_type'].'" required>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" class="btn btn-primary">
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

