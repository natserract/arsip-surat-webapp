
<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else $page = 'dashboard';

        
    if($page == "dashboard") include ("pages/dashboard.php");
    else if($page == "backup") include ("pages/backup.php");
    else if($page == "backup-process") include ("pages/backup-process.php");
    else if($page == "restore") include ("pages/restore.php");
    else if($page == "users") include ("pages/users.php");
    else if($page == "users-new") include ("pages/users-new.php");
    else if($page == "users-edit") include ("pages/users-edit.php");
    else if($page == "incoming-mail") include ("pages/incoming-mail.php");
    else if($page == "incoming-mail-new") include ("pages/incoming-mail-new.php");
    else if($page == "incoming-mail-edit") include ("pages/incoming-mail-edit.php");
    else if($page == "incoming-mail-detail") include ("pages/incoming-mail-detail.php");
    else if($page == "incoming-mail-detail-print") include ("pages/incoming-mail-detail-print.php");
    else if($page == "incoming-mail-print") include ("pages/incoming-mail-print.php");
    else if($page == "outgoing-mail") include ("pages/outgoing-mail.php");
    else if($page == "outgoing-mail-new") include ("pages/outgoing-mail-new.php");
    else if($page == "outgoing-mail-edit") include ("pages/outgoing-mail-edit.php");
    else if($page == "outgoing-mail-detail") include ("pages/outgoing-mail-detail.php");
    else if($page == "outgoing-mail-detail-print") include ("pages/outgoing-mail-detail-print.php");
    else if($page == "outgoing-mail-print") include ("pages/outgoing-mail-print.php");
    else if($page == "mail-disposition") include ("pages/mail-disposition.php");
    else if($page == "mail-disposition-new") include ("pages/mail-disposition-new.php");
    else if($page == "mail-disposition-delete") include ("pages/mail-disposition-delete.php");
    else if($page == "mail-disposition-edit") include ("pages/mail-disposition-edit.php");
    else if($page == "mail-disposition-print") include ("pages/mail-disposition-print.php");
    else if($page == "disposition") include ("pages/disposition.php");
    else if($page == "disposition-edit") include ("pages/disposition-edit.php");
    else if($page == "disposition-delete") include ("pages/disposition-delete.php");
    else if($page == "profile") include ("pages/profile.php");
    else if($page == "change-password") include ("pages/change-password.php");
    else if($page == "404") include ("pages/404.php");

    else {
        echo "<h2 class='text-center' style='color: #000'>Kontent Tidak Ada</h2>";
        echo "<h2 class='text-center' style='color: #000'>404</h2>";
    }
?>
