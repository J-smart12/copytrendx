<?php 
    session_start();
    include './account/includes/require2.php';
    include './account/includes/config.php';
    include './account/includes/admin.php';
    
    if(isset($_SESSION['administrator'])) {
        session_unset();
        session_destroy();
    }

    if(isset($_POST['admin_login'])) {
        $admin = new Admin($db);

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $loggedIn = $admin->login(["email"=>$email,"password"=>$password]);

        if($loggedIn) {
            echo '
                <script>
                    window.location = "./account";
                </script>
            ';
        }else{
            $err = 'Incorrect Data';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stormy Wellington | Admin | Login</title>

<link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="./vendors/nprogress/nprogress.css" rel="stylesheet">

<link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

<link href="./build/css/custom.min.css" rel="stylesheet">
<meta name="robots" content="noindex, follow">
<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <?php echo (isset($err)? '<div class="alert alert-danger">'.$err.'</div>' : null) ?>
            <?php $err = null; ?>
            <div class="animate form login_form">
                <section class="login_content"><br>
                    <form action="./" method="POST">
                        <h1>Login</h1>
                        <div>
                            <input type="text" name="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit" name="admin_login">Log in</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
