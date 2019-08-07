<?php 
    //View surat keluar
    $outgoingID = $_GET['mail'];
    $queryDis = "SELECT * FROM tb_mail_out WHERE id_mail_out = '$outgoingID'";
    $result = $fungsi->execute($queryDis);
    $data = mysqli_fetch_array($result);

    if($leader){
        echo "<script>window.location.href = 'index.php?page=404'</script>";
    }

    if(isset($_POST['update'])){
        $mailcode = $_POST['mail_code'];
        $mailto = $_POST['mail_to'];
        $subject = $_POST['subject'];
        $desc = $_POST['desc'];
        $mailtype = $_POST['mail_type'];
        $user = $_SESSION['level'];
        $file = $_FILES['file_upload']['name'];
        $lokasi = $_FILES['file_upload']['tmp_name'];
        $dir = "././mc-userfiles/Outgoing Mail/";

        $filebasename = substr($file, 0, strripos($file, '.'));
        $file_ext = substr($file, strripos($file,  '.'));
        $filesize = $_FILES['file_upload']['size'];
        $allowed_file_type = array('.jpg', '.png', '.pdf');
        $newfilename = uniqid() . $file_ext;

        $table = 'tb_mail_out'; 

        $set = 
        "
        mail_code='$mailcode',
        mail_to='$mailto', 
        mail_subject='$subject', 
        mail_description='$desc', 
        id_mail_type='$mailtype', 
        id_user='$user'
        ";

        $setWFile = 
        "
        mail_code='$mailcode',
        mail_to='$mailto', 
        mail_subject='$subject', 
        mail_description='$desc', 
        id_mail_type='$mailtype', 
        id_user='$user',
        file_upload = '$newfilename'
        ";

        $checkFiles = "'$file'";
        $key = "id_mail_out='$outgoingID'";

        $fileDelete = "././mc-userfiles/Outgoing Mail/".$data['file_upload'];

        $result_update = $fungsi->updateWFile($table, $set, $setWFile,  $key, $checkFiles, $fileDelete);

        if($result_update){
            move_uploaded_file($lokasi,"$dir$newfilename");
            echo "
            <script>
                window.location.href = 'index.php?page=outgoing-mail';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal update');
            </script>";
        }
    }

?>

<title>Edit Outgoing Mail
    <?php echo $title; ?>
</title>

<div class="outgoing-mail-edit" style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Edit Outgoing Mail</h1>
        </div>

        <div class="outgoing-mail-section">
            <form action="" method="post" enctype="multipart/form-data" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="mailcode">Mail code</label>
                            <input type="text" name="mail_code" value="<?php echo $data['mail_code']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="mailto">Mail to</label>
                            <input type="text" name="mail_to" value="<?php echo $data['mail_to']; ?>" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" value="<?php echo $data['mail_subject']; ?>" required="50">
                        </div>
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
                                <option value="<?php echo $data['id_mail_type']; ?>">
                                    <?php echo $typeMail; ?>
                                </option>
                                <option value="1">Invitation</option>
                                <option value="2">Official</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="desc">Short description</label>
                            <textarea name="desc" required="" maxlength="300"><?php echo $data['mail_description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file_upload">
                            <label for="filename">
                                <?php echo $data['file_upload']; ?>
                            </label>
                            <h6 class="rules-upload">(Only JPEG, PNG, DOC, DOCX, PDF format and max file 2 MB!)</h6>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="update" value="Update">
                    <a href="index.php?page=outgoing-mail" class="btn-cancel">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>