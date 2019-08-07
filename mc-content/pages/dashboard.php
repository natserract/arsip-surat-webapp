<?php
   //Query for count incoming mail
   $queryMailIn = "SELECT * FROM tb_mail_in";
   $execMailIn = $fungsi->execute($queryMailIn);
   $countMailIn = mysqli_num_rows($execMailIn);

   //Query for count outgoing mail
   $queryMailOut = "SELECT * FROM tb_mail_out";
   $execMailOut = $fungsi->execute($queryMailOut);
   $countMailOut = mysqli_num_rows($execMailOut);

   //Query for count disposition
   $queryDisposition = "SELECT * FROM tb_disposition";
   $execDisposition = $fungsi->execute($queryDisposition);
   $countDisposition = mysqli_num_rows($execDisposition);

   //Query for count mail not yet disposition
   $queryNotYet = "SELECT * FROM tb_mail_in WHERE status = 0";
   $execNotYet = $fungsi->execute($queryNotYet);
   $countNotYet = mysqli_num_rows($execNotYet);


?>

<title>Dashboard
    <?php echo $title; ?>
</title>
<link rel="stylesheet" href="././mc-assets/css/dashboard.css">

<div class="dashboard" style="padding-bottom: 25em;">
    <div class="mc-container">
        <div class="welcome-panel panel">
            <div class="welcome-panel-content">
                <h2>Welcome to MailChips!</h2>
                <p class="about-description">We’ve assembled some links to get you started:</p>
                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column">
                        <h3>Get started</h3>
                        <a href="index.php?page=incoming-mail" class="button-to">See Incoming Mail</a>
                    </div>
                    <div class="welcome-panel-column">
                        <h3>Next Steps</h3>
                        <ul>
                            <li>
                                <a href="index.php?page=outgoing-mail">
                                    <span class="fa fa-envelope"></span> See Outgoing Mail</a>
                            </li>
                            <?php if($admin || $receptionist){ ?>
                            <li>
                                <a href="index.php?page=incoming-mail-new">
                                    <span class="fa fa-plus"></span> Create Incoming Mail</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php if($admin) { ?>
                    <div class="welcome-panel-column">
                        <h3>More Actions</h3>
                        <ul>
                            <li>
                                <a href="index.php?page=users">
                                    <span class="fa fa-users"></span> Manage Users</a>
                            </li>
                            <li>
                                <a href="index.php?page=backup">
                                    <span class="fa fa-retweet"></span> Backup Your Database</a>
                            </li>
                            <li>
                                <a href="index.php?page=restore">
                                    <span class="fa fa-shield"></span> Restore Your Database</a>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="left-box">
                <a href="index.php?page=incoming-mail">
                    <div class="mail-box-left panel">
                        <div class="mail-box-content">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope-open"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int">
                                    <?php echo  $countMailIn; ?>
                                </div>
                                <div class="widget-title">Incoming Mail</div>
                                <div class="widget-subtitle">In Your MailBox</div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="index.php?page=disposition">
                    <div class="disposisi-box panel">
                        <div class="disposisi-box-content">
                            <div class="widget-item-left">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int">
                                    <?php echo $countDisposition; ?>
                                </div>
                                <div class="widget-title">Disposition</div>
                                <div class="widget-subtitle">On MailChips Website</div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="right-box">
                <a href="index.php?page=outgoing-mail">
                    <div class="mail-box-right panel panel panel-right">
                        <div class="mail-box-column">
                            <div class="mail-box-content">
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int">
                                        <?php echo $countMailOut; ?>
                                    </div>
                                    <div class="widget-title">Outgoing Mail</div>
                                    <div class="widget-subtitle">In Your MailBox</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="index.php?page=incoming-mail">
                    <div class="user-box panel panel-right">
                        <div class="user-box-column">
                            <div class="user-box-content">
                                <div class="widget-item-left">
                                    <span class="fa fa-mail-reply"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int">
                                        <?php echo $countNotYet; ?>
                                    </div>
                                    <div class="widget-title">Amount of letters not yet disposition</div>
                                    <div class="widget-subtitle">On MailChips Website</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
