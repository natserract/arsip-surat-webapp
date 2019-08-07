<?php 
    //Query when get id disposition
    $mail = $_GET['mail'];
    $id = $_GET['disposition-edit'];
    $query = "SELECT * FROM tb_disposition WHERE id_disposition = '$id'";
    $main = $fungsi->execute($query);
    $data = mysqli_fetch_array($main);

    if(isset($_POST['update'])){
        $to = $_POST['disposition-to'];
        $description = $_POST['disposition-ket'];
        $type = $_POST['disposition-type'];
        $user = $_SESSION['level'];

        $table = "tb_disposition";
        $set = 
        "
        reply_at = '$to',
        description = '$description',
        notification = '$type',
        id_mail_in = '$mail',
        id_user = '$user'
        ";
        $key = "id_disposition = '$id'";
        $update = $fungsi->update($table, $set, $key);

        if($update) {
            echo "<script>window.location.href='index.php?page=disposition';</script>";
        }
        else {
            echo "<script>alert('Failed to edit disposition');</script>";
        }
    }

    if($receptionist){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }
?>

<title>Edit Disposition
    <?php echo $title; ?>
</title>

<div class="disposition-edit" style="padding-bottom: 12em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Edit Disposition</h1>
        </div>

        <div class="disposition-edit-content">
            <form action="" method="post" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="to">Disposition to</label>
                            <input type="text" name="disposition-to" value="<?php echo $data['reply_at']; ?>" class="focus" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="description">Short Description</label>
                            <textarea name="disposition-ket" required="" maxlength="200"><?php echo $data['description']; ?></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="dispositiontype">Disposition type</label>
                            <select name="disposition-type" required="">
                                <?php 
                                    if($data['notification'] == 1){
                                        $type = "Important";
                                    }else if ($data['notification'] == 2){
                                        $type = "Soon";
                                    }
                                    else if ($data['notification'] == 3){
                                        $type = "Secret";
                                    }
                                ?>
                                <option value="<?php echo $data['notification'] ?>"><?php echo $type; ?></option>
                                <option value="1">Important</option>
                                <option value="2">Soon</option>
                                <option value="3">Secret</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="update" value="Update">
                    <a href="index.php?page=mail-disposition&mail-disposition=<?php echo $data['id_mail_in']; ?>" class="btn-cancel">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>