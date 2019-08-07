<?php 
    $getuserid = $_GET['userid'];
    $query = "SELECT * FROM tb_user WHERE id_user = '$getuserid'";
    $main = $fungsi->execute($query);
    $data = mysqli_fetch_array($main);

    if(isset($_POST['update'])){
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $nip = $_POST['nip'];
      
        $table = "tb_user";
        $set = "
            user_username = '$username',
            fullname = '$fullname',
            nip = '$nip'
        ";
        $key = "id_user='$getuserid'";
        $update = $fungsi->update($table, $set, $key);
        if($update) {
            echo "<script>window.location.href = './';</script>";
        }
        else {
            echo "<script>alert('Failed to edit profile');window.location.href = 'index.php?page=profile';</script>";
        }
    }
?>

<title>Edit Profile <?php echo $title; ?></title>

<div class="profile" style="margin-bottom: 7em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Edit Profile</h1>
        </div>

        <div class="profile-content">
            <form action="" method="POST" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?php echo $data['user_username'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" name="fullname" value="<?php echo $data['fullname'] ?>">
                        </div>
                        
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                    <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" value="<?php echo $data['nip'] ?>">
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