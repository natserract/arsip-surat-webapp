<?php 
    if($leader){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }

    //Deklarasi 
    if(isset($_POST['save'])) {
        $mailfrom = $_POST['mail_from'];
        $mailcode = $_POST['mail_code'];
        $incoming_at = date('Y-m-d');
        $mailcreate = $_POST['mail_create'];
        $subject = $_POST['subject'];
        $mailto = $_POST['mail_to'];
        $mailtype = $_POST['mail_type'];
        $desc = $_POST['desc'];
        $user = $_SESSION['level'];

        //Mail Status
        $mailStatus = 0;

        $target_dir = "././mc-userfiles/Incoming Mail/";
        $file = $_FILES['file_upload']['name'];
        $file_type = $_FILES['file_upload']['type'];
        $lokasi = $_FILES['file_upload']['tmp_name'];

        $filebasename = substr($file, 0, strripos($file, '.'));
        $file_ext = substr($file, strripos($file,  '.'));
        $filesize = $_FILES['file_upload']['size'];
        $allowed_file_type = array('.JPG', '.jpeg', '.jpg', '.png', '.pdf');
        
        if(in_array($file_ext, $allowed_file_type) && ($filesize < 20000000)){
            $newfilename = uniqid() . $file_ext;
            if(file_exists("././mc-userfiles/Incoming Mail/" . $newfilename)){
                echo "<script>alert('File has been uploaded'); window.location.href='index.php?page=incoming-mail-new'</script>";
            } else {
                $table = 'tb_mail_in';  
                
                $field = 'mail_from, mail_code, incoming_at, mail_date, mail_subject, mail_to, mail_description, status, id_mail_type, id_user, file_upload ';
        
                $values = "'$mailfrom', '$mailcode', '$incoming_at', '$mailcreate', '$subject', '$mailto', '$desc',  '$mailStatus', '$mailtype', '$user', ";
        
                $files = "'$newfilename'";
        
                $result = $fungsi->postWFile($table, $field, $values, $files);
        
        
                if($result) {
                    move_uploaded_file($lokasi, "$target_dir$newfilename");
                    echo "<script>window.location.href='index.php?page=incoming-mail'</script>";
                    
                }
            }
        } else if($filesize > 20000000){
            echo "<script>alert('File too large');  window.location.href='index.php?page=incoming-mail-new'</script>";
        } else {
            echo "<script>alert('Sorry file type upload is a PNG, JPG, & PDF');  window.location.href='index.php?page=incoming-mail-new'</script>";
        }
        
    }

    
?>

<title>Add New Incoming Mail
    <?php echo $title; ?>
</title>


<div class="incoming-mail-new" style="margin-bottom: 7em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Add New Incoming Mail</h1>
        </div>

        <div class="post-section">
            <form action="" method="post" enctype="multipart/form-data" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailfrom">Mail from</label>
                            <input type="text" name="mail_from" autofocus required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="mailcode">Mail code</label>
                            <input type="text" name="mail_code" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="maildate">Date of mail created</label>
                            <input type="date" name="mail_create"  required="">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" required="50">
                        </div>
                         <div class="form-group">
                            <label for="mailto">Mail to</label>
                            <input type="text" name="mail_to" required="" maxlength="50">
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailtype">Mail type</label>
                            <select name="mail_type" required>
                                <option value>Choose mail type</option>
                                <option value="1">Invitation</option>
                                <option value="2">Official</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desc">Short Description</label>
                            <textarea name="desc" required maxlength="200"></textarea>
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
                    <button onclick="window.history.back()" class="btn-cancel">Cancel</button>
                </p>
            </form>
        </div>
    </div>
</div>
