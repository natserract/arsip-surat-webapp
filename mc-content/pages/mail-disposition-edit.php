
<?php 
    $mailId = $_GET['mail-disposition'];
    $disposisi = $_GET['mail-disposition-edit'];

    $query = "SELECT * FROM tb_disposition WHERE id_disposition = '$disposisi'";
    $result = $fungsi->execute($query);
    $data = mysqli_fetch_array($result);

    if($receptionist){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }

    if(isset($_POST['update'])){
        $to = $_POST['disposition-to'];
        $typeDisposition = $_POST['disposition-type'];
        $descDisposition = $_POST['disposition-ket'];

        $nama_table = 'tb_disposition';
        $set = 
        "reply_at='$to',
        notification = '$typeDisposition',
        description='$descDisposition'
        ";
        $key = "id_disposition='$disposisi'";
        $result_update = $fungsi->update($nama_table, $set, $key);

        if($result_update){
?>
            <script>
                window.location.href='index.php?page=mail-disposition&mail-disposition=<?php echo $data['id_mail_in']; ?>';
            </script>";
<?php
        }
    }
?>

<title>Edit Mail Disposition <?php echo $title; ?></title>

<div class="edit-disposition" style="padding-bottom: 12em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Edit Mail Disposition</h1>
        </div>

        <div class="edit-disposition-section">
        <form action="" method="post" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="dispositionto">Disposition to</label>
                            <input type="text" name="disposition-to" value="<?php echo $data['reply_at'] ?>" class="focus" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="disposition-ket">Short Description</label>
                            <textarea name="disposition-ket" required="" maxlength="300"><?php echo $data['description']; ?></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="dispositiontype">Disposition type</label>
                            <select name="disposition-type">
                                <?php 
                                    if($data['notification'] == 1) {
                                        $type = 'Important';
                                    }
                                    else if($data['notification'] == 2) {
                                        $type = 'Soon';
                                    }
                                    else if($data['notification'] == 3) {
                                        $type = 'Secret';
                                    }
                                ?>

                                <option value="<?php echo $data['notification']; ?>"><?php echo $type; ?></option>
                                <option value="1">Important</option>
                                <option value="2">Soon</option>
                                <option value="3">Secret</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="update" value="Update">
                    <a href="index.php?page=incoming-mail" class="btn-cancel">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>