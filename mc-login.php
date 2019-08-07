<!-- Login-->
<?php 
    include 'mc-functions.php';
    $fungsi = new Databases();
    session_start();    

    if(isset($_POST['btn-login'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $pass_encrypted = md5($pass);

        $sql = "SELECT * FROM tb_user WHERE user_username = '$username' AND user_password = '$pass_encrypted'";
        $result = $fungsi->execute($sql);
        $row = mysqli_fetch_array($result);

        $post = mysqli_num_rows($result);

    

        if($post > 0){
                $userid = $row['id_user'];
                $dbusername = $row['user_username'];
                $dbpass = $row['user_password'];
                $dbfullname = $row['fullname'];
                $nip = $row['nip'];
                $dblevel = $row['level'];
            
                
            if($username == $dbusername && $pass_encrypted == $dbpass){
                $_SESSION['userid'] = $userid;
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $dbfullname;    
                $_SESSION['nip'] = $nip;
                $_SESSION['level'] = $dblevel;
                $_SESSION['user_login'] = 1;
              header("Location: ./");
              
            }

        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }
    }

    if(isset($_SESSION['user_login'])){
        echo "<script>window.location.href = './'</script>";
    } 
?>


<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="mc-assets/css/front.css" />
    <link rel="stylesheet" href="mc-assets/css/login.css" />
    <link rel="shortcut icon" href="mc-assets/img/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="mc-assets/js/front.js"></script>
    <title>Login
        <?php echo $title; ?>
    </title>
</head>

<body class="login">
    <div class="mc-container">
        <div class="main">
            <div class="mc-brand">
                <h1>
                    <a href="./" title="Powered by MailChips">MailChips</a>
                </h1>
            </div>
            <div class="mc-login-box">
                <form role="form" name="loginform" id="loginform" method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" required="" id="username" name="username" class="focus" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password :</label>
                        <input type="password" required="" id="pass" name="pass" maxlength="35">
                    </div>
                    <button type="submit" name="btn-login" class="btn-login">
                        Log In
                    </button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>


<!-- End login -->