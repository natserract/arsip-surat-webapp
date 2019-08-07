<?php 
    if(isset($_POST['save'])){
        $mailcode = $_POST['mail_code'];
        $mailcreate = date('Y-m-d');
        $mailto = $_POST['mail_to'];
        $subject = $_POST['subject'];
        $mailtype = $_POST['mail_type'];
        $desc = $_POST['desc'];
        $user = $_SESSION['level'];
       

        $target_dir = "././mc-userfiles/Outgoing Mail/";
        $file = $_FILES['file_upload']['name'];
        $lokasi = $_FILES['file_upload']['tmp_name'];

        $filebasename = substr($file, 0, strripos($file, '.'));
        $file_ext = substr($file, strripos($file,  '.'));
        $filesize = $_FILES['file_upload']['size'];
        $allowed_file_type = array('.JPG', '.jpeg', '.jpg', '.png', '.pdf');

        if(in_array($file_ext, $allowed_file_type) && ($filesize < 20000000)){
            $newfilename = uniqid() . $file_ext;
            if(file_exists("././mc-userfiles/Outgoing Mail/" . $newfilename)){
                echo "<script>alert('File has been uploaded'); window.location.href='index.php?page=outgoing-new'</script>";
            } else {
                $table = 'tb_mail_out';
                
                $field = 'mail_code, mail_date, mail_to, mail_subject, id_mail_type, mail_description, id_user, file_upload ';
                
                $values = "'$mailcode', '$mailcreate', '$mailto', '$subject', '$mailtype', '$desc', '$user', ";
        
                $files = "'$newfilename'";
        
                $result = $fungsi->postWFile($table, $field, $values, $files);
        
                if($result) {
                    move_uploaded_file($lokasi, "$target_dir$newfilename");
                    echo "<script>window.location.href = 'index.php?page=outgoing-mail'</script>";
                    
                }
            }
        } else if($filesize > 20000000){
            echo "<script>alert('File too large');  window.location.href='index.php?page=outgoing-mail-new'</script>";
        } else {
            echo "<script>alert('Sorry file type upload is a PNG, JPG, & PDF');  window.location.href='index.php?page=outgoing-mail-new'</script>";
        }

      
    }

    if($leader){
        echo "<script>window.location.href = 'index.php?page=404'</script>";
    }
?>

<title>Add New Outgoing Mail
    <?php echo $title; ?>
</title>

<div class="outgoing-mail-new" style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Add New Outgoing Mail</h1>
        </div>

        <div class="outgoing-section">
            <form action="" method="post" enctype="multipart/form-data" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailcode">Mail code</label>
                            <input type="text" name="mail_code" required="" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="mailto">Mail to</label>
                            <input type="text" name="mail_to" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" required="50">
                        </div>
                        <div class="form-group">
                            <label for="mailtype">Mail type</label>
                            <select name="mail_type" required>
                                <option value>Choose mail type</option>
                                <option value="1">Invitation</option>
                                <option value="2">Official</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="desc">Short Description</label>
                            <textarea name="desc" required="" maxlength="200"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file_upload" required>
                            <h6 class="rules-upload">(Only JPEG, PNG, DOC, DOCX, PDF format and max file 2 MB!)</h6>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="save" value="Save">
                    <a href="index.php?page=outgoing-mail" class="btn-cancel">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>

<!-- Field -->