<?php 
    session_start();
    if((!empty($_SESSION['administrator']))) {
        include './includes/require.php';
        $admin = new Admin($db);

        $clients = $admin->getClients();
        $messages = $admin->newMessages();
        $lmessages = $admin->LimnewMessages();
        // $verClients = $admin->getVerifications();
    }else{
        header('location:../../admin/');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />
        <title>Admin | <?php echo (isset($page_title))? $page_title :null ?> Stormyfx.com</title>

        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="../build/css/custom.min.css" rel="stylesheet">
        <meta name="robots" content="index, nofollow">
    </head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                    <a href="./index.php" class="site_title"><i class="fa fa-paw"></i> <span>Admin</span></a>
                </div>
                <div class="clearfix"></div>
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="./images/user.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>Admin</h2>
                    </div>
                </div>
                <br />
                
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="./">Dashboard</a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-edit"></i> Actions <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="./top_up.php">Top up Balance</a></li>
                                <li><a href="./profit.php">Add Profit</a></li>
                                <li><a href="./updateDeposited.php">Update Deposited</a></li>
                                <li><a href="./bonus.php">Add Bonus</a></li>
                                <li><a href="./addnewwallet.php">New wallet</a></li>
                                <li><a href="./changewallet.php">Edit wallet address</a></li>
                                <li><a href="./referal.php">Referal Bonus</a></li>
                                <li><a href="./validate.php">Validate Transaction</a></li>
                                <li><a href="./settaxcode.php">Generate codes</a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fa fa-desktop"></i>More<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="./delete.php">Delete Account</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="./logout.php">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="./images/user.jpg" alt="">Administrator
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                    <li role="presentation" class="nav-item dropdown open">
                        <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-green"></span>
                        </a>
                        <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                            <?php 
                                foreach($lmessages as $lmessage) {
                                    echo '
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="./message.php">
                                            <span>
                                                <span></span>
                                                <span class="time">'.$lmessage['createdAt'].'</span>
                                            </span>
                                            <span class="message">
                                                '.$lmessage['remark'].'
                                            </span>
                                        </a>
                                    </li>
                                    ';
                                }
                            ?>
                            
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
