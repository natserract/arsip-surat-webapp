
<?php 
    $getuserid = $_GET['userid'];

    if(isset($_POST['update'])){
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
       
        $queryuser = "SELECT * FROM tb_user WHERE user_password = '$old_password'";
        $exec = $fungsi->execute($queryuser);
        $check = mysqli_num_rows($exec);

        if(!$check >= 1){
?>
        <script>alert('Sorry your old password is wrong'); window.location.href='index.php?page=change-password&userid=<?php echo $getuserid ?>'</script>

<?php
        } else if ($new_password != $confirm_password){
?>
           <script>alert('Sorry password must be same'); window.location.href='index.php?page=change-password&userid=<?php echo $getuserid ?>'</script>
<?php 
        } else {
            $table = "tb_user";
            $set = "
                user_password = '$new_password'
            ";
            $key = "id_user='$getuserid'";
            $update = $fungsi->update($table, $set, $key);
            if($update) {
            echo "
                <script>alert('Sucess update your password. Please Re-Login to secure your password');window.location.href = './';</script>";
                session_destroy();
            }
            else {
?>
                <script>alert('Failed to edit password');window.location.href = 'index.php?page=change-password&userid=<?php echo $getuserid ?>';</script>
<?php
            }
        }
    }
?>

<title>Change Password <?php echo $title; ?></title>

<div class="profile" style="margin-bottom: 7em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Change Password </h1>
        </div>

        <div class="profile-content">
            <form action="" method="POST" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="oldpass">Old password</label>
                            <input type="password" name="old_password" required>
                        </div>
                        <div class="form-group">
                            <label for="newpass">New password</label>
                            <input type="password" name="new_password" required>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                    <div class="form-group">
                            <label for="confirm">Confirm new password</label>
                            <input type="password" name="confirm_password" required>
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