
<?php
    //Method get
    $id = $_GET['mail'];
    $query = "SELECT * FROM tb_mail_in WHERE id_mail_in = '$id'";
    $result = $fungsi->execute($query);
    $data = mysqli_fetch_array($result);

    if($leader){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }

    //Method post
        if(isset($_POST['update'])){
            $mailfrom = $_POST['mail_from'];
            $mailcode = $_POST['mail_code'];
            $mailcreate = $_POST['mail_create'];
            $subject = $_POST['subject'];
            $mailto = $_POST['mail_to'];
            $mailtype = $_POST['mail_type'];
            $desc = $_POST['desc'];
            $user = $_SESSION['level'];
            $file = $_FILES['file_upload']['name'];
            $lokasi = $_FILES['file_upload']['tmp_name'];
            $dir = "././mc-userfiles/Incoming Mail/";

            $filebasename = substr($file, 0, strripos($file, '.'));
            $file_ext = substr($file, strripos($file,  '.'));
            $filesize = $_FILES['file_upload']['size'];
            $allowed_file_type = array('.jpg', '.png', '.pdf');
            $newfilename = uniqid() . $file_ext;


            $table = 'tb_mail_in'; 

            $set = 
            "
            mail_from='$mailfrom',
            mail_code='$mailcode',
            mail_date='$mailcreate', 
            mail_subject='$subject', 
            mail_to='$mailto', 
            mail_description='$desc', 
            id_mail_type='$mailtype', 
            id_user='$user'
            ";

            $setWFile = 
            "
            mail_from='$mailfrom',
            mail_code='$mailcode',
            mail_date='$mailcreate', 
            mail_subject='$subject', 
            mail_to='$mailto', 
            mail_description='$desc', 
            id_mail_type='$mailtype', 
            id_user='$user',
            file_upload = '$newfilename'
            ";

            $checkFiles = "'$file'";
            $key = "id_mail_in='$id'";

            $fileDelete = "././mc-userfiles/Incoming Mail/".$data['file_upload'];

            $result_update = $fungsi->updateWFile($table, $set, $setWFile, $key, $checkFiles, $fileDelete);

            if($result_update){
                move_uploaded_file($lokasi,"$dir$newfilename");
                echo "
                <script>
                    window.location.href='index.php?page=incoming-mail';
                </script>";
            } else {
                echo "
                <script>
                    alert('Failed to update');
                    window.location.href='index.php?page=incoming-mail-edit';
                </script>";
            }
        }

?>
<title>Edit Incoming Mail <?php echo $title; ?></title>

<div class="incoming-mail-edit" style="margin-bottom: 7em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Edit Incoming Mail</h1>
        </div>

        <div class="edit-section">
        <form action="" method="POST" enctype="multipart/form-data" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailfrom">Mail from</label>
                            <input type="text" name="mail_from" value="<?php echo $data['mail_from']; ?>" class="focus" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="mailcode">Mail code</label>
                            <input type="text" name="mail_code" value="<?php echo $data['mail_code']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="maildate">Date of mail created</label>
                            <input type="date" name="mail_create" value="<?php echo $data['mail_date']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" value="<?php echo $data['mail_subject']; ?>" required="50">
                        </div>
                        <div class="form-group">
                            <label for="mailto">Mail to</label>
                            <input type="text" name="mail_to" value="<?php echo $data['mail_to']; ?>" required="" maxlength="50">
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailtype">Mail type</label>
                            <select name="mail_type" required>
                            <?php 
                                if($data['id_mail_type'] == 1){
                                    $typeMail = 'Invitation';
                                } else if ($data['id_mail_type'] == 2){
                                    $typeMail = 'Official';
                                }
                            ?>
                            <option value="<?php echo $data['id_mail_type']; ?>"><?php echo $typeMail; ?></option>
                            <option value="1">Invitation</option>
                            <option value="2">Official</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="desc">Short description</label>
                            <textarea name="desc" required="" maxlength="200"><?php echo $data['mail_description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="file-upload"> 
                                <input type="file" value="" name="file_upload">
                                <label for="filename"><?php echo $data['file_upload']; ?></label>
                            </div>
                            <h6 class="rules-upload">(Only JPEG, PNG, DOC, DOCX, PDF format and max file 2 MB!)</h6>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="update" value="Update">
                    <a href="javascript:;" onclick="window.history.back()" class="btn-cancel">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>