<?php
    include_once ("mc-functions.php");
    $fungsi = new Databases();
    $widget = new Widget();
    $maintenance = new Maintenance();

    //session start here
    session_start();

    //If user not logged in
    if(!isset($_SESSION['user_login'])){
        header("Location: mc-login.php");
    } 

    //Settings User level
    $admin = $_SESSION['level'] == 1;
    $receptionist = $_SESSION['level'] == 2;
    $leader = $_SESSION['level'] == 3;

    //Get session user id
    $userid = $_SESSION['userid'];

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="mc-assets/css/front.css" />
        <link rel="shortcut icon" href="mc-assets/img/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="mc-assets/js/front.js"></script>
    </head>

    <body class="universal">
        <!-- Dropdown Menu -->
        <ul class="dropdown-profile dropdown" id="dropdown1">
           
            <li role="presentation">
                <a role="menuitem" href="index.php?page=change-password&userid=<?php echo $userid ?>">
                    Change password</a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="mc-logout.php">
                    Log Out</a>
            </li>
        </ul>

        <ul class="dropdown-settings dropdown" id="dropdown2">
            <li role="presentation">
                <a role="menuitem" href="index.php?page=backup">
                    Backup Database</a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="index.php?page=restore">
                    Restore Database</a>
            </li>
        </ul>
        <!-- Dropdown Menu End  -->

        <!-- Navigation Start -->
        <nav class="mc-navbar fixed">
            <div class="mc-container">
                <div class="header-container">
                    <div class="mc-nav-header">
                        <div class="mc-nav-brand text-center">
                            <div class="mc-header-title-inner">
                                <h1 class="site-title">
                                    <a href="./" title="MailChips">MailChips</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="mc-header-menu-wrap">
                        <div class="mc-nav mc-nav-left">
                            <ul>
                                <li>
                                    <a href="index.php?page=dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <a href="index.php?page=incoming-mail">Incoming Mail</a>
                                </li>
                                <li>
                                    <a href="index.php?page=outgoing-mail">Outgoing Mail</a>
                                </li>
                                <?php 
                                    if($admin){
                                ?>
                                <li>
                                    <a href="index.php?page=disposition">Disposition</a>
                                </li>
                                <li>
                                    <a href="index.php?page=users">Users</a>
                                </li>
                                <li>
                                    <a href="javascript:;" onclick="dropdown()" class="a-settings">Settings
                                        <span class="fa fa-angle-down"></span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($leader || $receptionist){ ?>
                                <li>
                                    <a href="index.php?page=disposition">Disposition</a>
                                </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                    <div class="mc-nav-right">
                        <div class="header-profile">
                            <ul class="linear-list">
                                <li class="nav-link full-height">
                                    <a href="javascript:;" onclick="dropdownProfile()" class="account-button">
                                        <div class="logged-in-avatar">
                                            <?php 
                                                $fullname = $_SESSION['fullname'];
                                                $fullname_get_first = $fullname[0];
                                            ?>
                                            <span>
                                                <?php echo $fullname_get_first;  ?>
                                            </span>
                                        </div>
                                        <div class="account-name">
                                            <span>
                                                <?php echo $fullname; ?>
                                            </span>
                                            <?php 
                                                if($admin){
                                                    $level_mean = 'Administrator';
                                                }
                                                else if($receptionist){
                                                    $level_mean = 'Receptionist';
                                                }
                                                else if($leader){
                                                    $level_mean = 'Head of Agency';
                                                }
                                            ?>
                                            <span class="user-type">
                                                <?php echo $level_mean; ?>
                                            </span>
                                        </div>
                                        <span class="fa fa-angle-down down-icon text-bold "></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navigation End -->

        <!-- Content Start-->
        <div class="mc-content">
            <?php include_once("mc-content/index.php"); ?>
        </div>
        <!-- Content End -->

        <!-- Footer -->
        <footer class="mc-footer">
            <div class="mc-container">
                <div class="text-center">
                    <p>
                        <span>© Copyright 2018 - 2020. Allright reserved. Powered by
                            <strong>MailChips.</strong>
                        </span>
                    </p>
                </div>
            </div>
        </footer>
        <!-- Footer End -->
    </body>

    </html>