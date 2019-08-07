    
<?php 
    
    if(isset($_POST['save'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass_encrypted = md5($password);
        $fullname = $_POST['fullname'];
        $nip = $_POST['nip'];
        $usertype = $_POST['user_type'];

        $table = 'tb_user';
        $field = 'user_username, user_password, fullname, nip, level';
        $values = "'$username', '$pass_encrypted', '$fullname', '$nip', '$usertype'";

        $sql = "SELECT * FROM tb_user WHERE user_username = '$username'";
        $result = $fungsi->execute($sql);
        $row = mysqli_fetch_array($result);
        $post = mysqli_num_rows($result);

        //Validasi jika ada username yg sama
        if($post >= 1){
            echo "<script>alert('Sorry username has been created before' ); window.location.href='index.php?page=users-new'</script>";
        } else {
            $result = $fungsi->post($table, $field, $values);

            if($result) {
                echo "<script>window.location.href='index.php?page=users'</script>";
            } else {
                echo "<script>alert('Failed to add new user');  window.location.href='index.php?page=users'</script>";
            }
        }
    }

    if($_SESSION['level'] != 1){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }
?>

<title>Add New User <?php echo $title; ?></title>

<div class="add-new-user" style="margin-bottom: 8em">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Add New User</h1>
        </div>

        <div class="add-new-section">
            <form action="" method="post" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Username <i>(required)</i></label>
                            <input type="text" name="username"  class="focus" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <i>(required)</i></label>
                            <input type="password" name="password" required="">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname"  maxlength="50" required>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" name="nip" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="usertype">Type</label>
                            <select name="user_type" required="">
                                <option value>Choose user type</option>
                                <option value="2">Receptionist</option>
                                <option value="3">Disposition</option>
                            </select>
                        </div>
                        
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="save" value="Save">
                    <button  onclick="window.location.href='index.php?page=users'" class="btn-cancel">Cancel</button>
                </p>
            </form>
        </div>
    </div>
</div>
