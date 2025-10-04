<?php 
    $page_title = "Edit Details";
    include 'header.php';
    
    $cuser = $admin->getUserByusername('users',strip_tags($_POST['username']));
    
    if(isset($_POST['create'])) {
        $fullname = strip_tags($_POST['fullname']);
        $username = strip_tags($_POST['sender']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $tpin = strip_tags($_POST['tpin']);
        $account_number = strip_tags($_POST['acc_num']);
        
        $action = $admin->MultipleUpdate([
            'table'=>'users',
            "selector"=>"username",
            "selector_value"=>$username,
            ],[
            "logic"=>[
                "data"=>[
                    "email" =>$email,
                    "fullname" =>$fullname,
                    "accountNumber" =>$account_number,
                    "password" =>$password,
                    "transactionPin"=>$tpin
                ],
            ]
        ]);
        
        if($action) {
            echo '
                <script>
                    window.location = "edit.php?s=true";
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
                <h3>Change Details</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        
        
                        <!-- row -->
		<div class="container-fluid">
			<!-- row -->
			<div class="row">
				<!-- --column-- -->
				<div class="col-xl-12">
					<div class="col-xl-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Change Details <i class="fa fa-user"></i></h4>
							</div>
							<div class="card-body">
								<div class="basic-form">
									<form id="submitForm" method="POST" action="./editData.php">
										<div class="row">
											<input type="hidden" name="sender" id="sender" value="<?php echo $cuser['username']; ?>" class="form-control">
											<input type="hidden" name="token" id="token" class="form-control">
											<div class="mb-3 col-md-4">
												<label class="form-label">User Fullname</label>
												<input type="text" name="fullname" id="fullname" value="<?php echo $cuser['fullname']; ?>"  class="form-control">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label">User Email</label>
												<input type="email" id="email" name="email" value="<?php echo $cuser['email']; ?>" class="form-control">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label">User Account Number</label>
												<input type="number" name="acc_num" id="acc_num" value="<?php echo $cuser['accountNumber']; ?>" class="form-control">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label">User Password</label>
												<input type="text" name="password" id="password" value="<?php echo $cuser['password']; ?>" class="form-control">
											</div>
											<div class="mb-3 col-md-4">
												<label class="form-label">User Transaction Pin</label>
												<input type="text" name="tpin" id="tpin" value="<?php echo $cuser['transactionPin']; ?>" class="form-control">
											</div>
										</div><br><br>
										
										<div class="form-group">
											<button type="submit" name="create" class="form-control btn btn-primary w-full">
											    Change
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!----/column-- -->
			</div>
			<!-- /row -->
        
    </div>
</div>

</div>
<?php 
    include 'footer.php';
?>

