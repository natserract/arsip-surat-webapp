
<?php
    if(!$admin){
        echo "<script>window.location.href = 'index.php?page=404'</script>";
    }

    if(isset($_POST['backup'])){
        $username = 'root';
        $database = "mailchips_db";
        $path = "C:/xampp/htdocs/mailchips/mc-database/mailchips_db".date("d-m-y").'.sql';

        $backup = $maintenance->backupDatabase($username, $database, $path);
        if($backup){
            echo "<script>alert('Database success di backup');window.location.href='index.php?page=backup'</script>";
        } 
    }
        
?>  

<title>Backup <?php echo $title; ?></title>
<link rel="stylesheet" href="././mc-assets/css/backup.css" />

<div class="backup" style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Backup Database</h1>
        </div>


        <div class="backup-content">
            <div class="wrap">
                <fieldset>
                    <p>When you click the button below MailChips will create an SQL file for you to save to your computer.</p>
                    <p>This format, which we call SQL, will contain the data in the database.</p>
                    <p>After saving the downloaded file, you can use the Import function in the restore menu to import data from this site.</p>
                </fieldset>

                <p class="submit">
                    <form action="" method="POST">
                        <button type="submit" name="backup" class="button">
                            <span class="fa fa-download"></span>
                            Download Backup File
                        </button>
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>







