<?php
     if($_SESSION['level'] != 1){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }

    if(isset($_POST['import'])){
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'mailchips_db';
        $filePath   = 'C:/xampp/htdocs/mailchips/mc-database/mailchips_db.sql';

        $restore = $maintenance->restoreDatabase($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);

        if($restore) {
            echo "<script>alert('Restore succeeded'); window.location.href='index.php?page=restore'</script>";
        } 
    }
?>


<title>
    Restore
    <?php echo $title; ?>
</title>
<link rel="stylesheet" href="././mc-assets/css/restore.css" />

<div class="restore"  style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Restore Database</h1>
        </div>

        <div class="restore-content">
            <div class="wrap">
                <fieldset>
                    <p>Please restore the database file then click
                        <b>"Restore"</b> button to restore the database from backup result that has been made before. If there
                        is no backup database file, please backup first through
                        <a href="index.php?page=backup">Backup Database</a> menu.</p>
                </fieldset>

                <form action="" method="POST">
                    <div class="submit">
                        <button type="submit" name="import" class="button">
                            <span class="fa fa-upload"></span>
                                Restore database
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
