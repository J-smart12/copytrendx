<?php 
    $page_title = "Add New Coin";
    include 'header.php';

    if(isset($_POST['addcoin'])) {
        $data = [
            "wallet_name" => $_POST['coin_name'],

            "wallet_address" => $_POST['wallet_address'],
           
        ];

        $action = $admin->AddNewCoin($data);

        if($action) {
            echo '
                <script>
                    window.location = "./newcoins.php?s=true";
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
                    <strong>Update Success!</strong> New coin has been added.
                </div>
            ';
        }
    ?>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Coin</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <form action="./newcoins.php" method="post">
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="coin-name">Coin Name <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="coin-name" name="coin_name" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="short-name">Short Name <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="short-name" name="short_name" required="required" class="form-control">
                </div>
            </div>

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="wallet-address">Wallet Address <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="wallet-address" name="wallet_address" required="required" class="form-control">
                </div>
            </div>

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_price">Current Price<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="current_price" name="current_price" required="required" class="form-control">
                </div>
            </div>
            
            <div class="ln_solid"></div>
            <center>
                <div class="item form-group"><br>
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" name="addcoin" class="btn btn-success">Add</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                </div>
            </center>
        </form>
    </div>
</div>

</div>
<?php 
    include 'footer.php';
?>

