<?php
    $mailID = $_GET['user-edit'];
    $query = "SELECT * FROM tb_user WHERE id_user = '$mailID'";
    $result = $fungsi->execute($query);
    $row = mysqli_fetch_array($result);

     if($_SESSION['level'] != 1){
        echo "<script>window.location.href = 'index.php?page=404'</script>";
    }

    if(isset($_GET['select-user'])){
        $userId = $_GET['select-user'];
        $query = "SELECT * FROM tb_user WHERE id_user='$userId'";
        $userResult = $fungsi->execute($query);
        $rowUser = mysqli_fetch_array($userResult);
    }


    if(isset($_POST['update'])){
        $username = $_POST['username'];
        $newpass = md5($_POST['new_password']);
        $confirm_pass = md5($_POST['confirm_password']);
        $fullname = $_POST['fullname'];
        $nip = $_POST['nip'];
        $mailType = $_POST['user_type'];

        $table = 'tb_user';
        $set = "
        user_username = '$username',
        fullname = '$fullname', 
        nip = '$nip', 
        level = '$mailType'
        ";
        $setWPassword = "
        user_username = '$username',
        user_password = '$newpass',
        fullname = '$fullname', 
        nip = '$nip', 
        level = '$mailType'
        ";
        $key = "id_user='$mailID'";

        if($newpass == ""){
            $update = $fungsi->update($table, $set, $key);
            
            if($update) {
                echo "<script>window.location.href = 'index.php?page=users';</script>";
            }
            else {
                echo "<script>alert('Failed to edit users');</script>";
            }
        } else {
           if($newpass != $confirm_pass){
?>
            <script>alert('Password must been same');window.location.href = 'index.php?page=users-edit&user-edit=<?php echo $mailID ?>';</script>

<?php 
           } else {
                $updateWPass = $fungsi->update($table, $setWPassword, $key);
                
                if($updateWPass) {
                    echo "<script>window.location.href = 'index.php?page=users';</script>";
                }
                else {
                    echo "<script>alert('Failed to edit users');</script>";
                }
            }
        }
    }

?>

    <title>Edit User <?php echo $title ?></title>
    <div class="users-edit" style="margin-bottom: 8em">
        <div class="mc-container">
            <div class="heading-title">
                <h1>Edit User</h1>
            </div>

            <div class="users-edit-section">
                <form action="" method="post" class="form-label">
                    <div class="unit">
                        <fieldset>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="<?php echo $row['user_username'] ?>">
                            </div>
                                <div class="form-group">
                            <label for="newpass">New password</label>
                            <input type="password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm">Confirm new password</label>
                            <input type="password" name="confirm_password">
                        </div>
                        </fieldset>
                    </div>
                    <div class="unit">
                        <fieldset>
                        <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" name="fullname" value="<?php echo $row['fullname'] ?>" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="number" value="<?php echo $row['nip'] ?>" name="nip" required maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="usertype">Type</label>
                                <select name="user_type" required="">
                                    <?php
                                        if($row['level'] == 1){
                                            $type = "Administrator";
                                        }
                                        else if($row['level'] == 2){
                                            $type = "Receptionist";
                                        }
                                        else if($row['level'] == 3){
                                            $type = "Leader";
                                        }
                                    ?>
                                        <option value="<?php echo $row['level'] ?>">
                                            <?php echo $type; ?>
                                        </option>
                                        <option value="2">Receptionist</option>
                                        <option value="3">Leader</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <p class="submit">
                        <input type="submit" name="update" value="Update">
                        <a href="index.php?page=users" class="btn-cancel">Cancel</a>
                    </p>
                </form>
            </div>
        </div>
    </div>