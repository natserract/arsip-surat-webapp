<?php 

    //Query untuk menampilkan semua user
    $query = "SELECT * FROM tb_user";
    $result_user = $fungsi->view($query);
    $result_vi = $fungsi->execute($query);
    $numrows = mysqli_num_rows($result_vi);

    //Query untuk delete user
    if(isset($_GET['delete'])){
        $nama_table = 'tb_user';
        $id = $_GET['delete'];
        $key = "id_user='$id'";

        $result_del = $fungsi->delete($nama_table, $key);

        if($result_del) {
            echo "<script>
                window.location.href = 'index.php?page=users';
            </script>";
         } else {
            echo "<script>alert('Data surat masuk gagal dihapus.'); window.location.href = 'index.php?page=users'</script>";
        }
    }

    if($_SESSION['level'] != 1){
        echo "<script>window.location.href = 'index.php?page=404'</script>";
    }
  
   
?>

<title>Users
    <?php echo $title; ?>
</title>
<link rel="stylesheet" href="././mc-assets/css/users.css" />
<div class="users" style="margin-bottom: 8em">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Users</h1>
        </div>


        <div class="header-top">
            <div class="new-box">
                <button class="add-incoming-mail" onclick="window.location.href='index.php?page=users-new'">Add New</button>
            </div>
            <!-- Search box -->
            <div class="search-box">
                <input type="search" onkeyup="search()" name="search" id="search" placeholder="Search users">
            </div>
            <!-- End search box -->
        </div>

        <div class="users-section">
            <table class="mc-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full name</th>
                        <th>NIP</th>
                        <th>User type</th>
                    </tr>
                </thead>
                <tbody id="table_filter">
                    <?php foreach($result_user as $key => $row) { ?>
                    <?php
                            if($row['level'] == 2 || $row['level'] == 3){    
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['user_username']; ?>
                                <div class="row-actions">
                                    <span class="edit">
                                        <a href="index.php?page=users-edit&user-edit=<?php echo $row['id_user']; ?>">Edit</a>
                                        <?php if($row['level'] == '2' || $row['level'] == '3') { ?> | </span>
                                    <span class="trash">
                                        <a onclick="return confirm('Are you sure you want to delete this user?')" href="index.php?page=users&delete=<?php echo $row['id_user']; ?>">Delete</a>
                                    </span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <?php echo $row['fullname']; ?>
                            </td>
                            <td>
                                <?php echo $row['nip']; ?>
                            </td>
                            <?php 
                                if($row['level'] == 1){
                                    $level = 'Administrator';
                                } 
                                else if($row['level'] == 2) {
                                    $level = 'Receptionist';
                                } 
                                else if($row['level'] == 3){
                                    $level = 'Head of Agency';
                                }
                            ?>
                            <td>
                                <?php echo $level; ?>
                            </td>
                        </tr>
                        <?php
                            } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>