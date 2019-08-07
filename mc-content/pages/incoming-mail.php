<?php 
    //Query untuk menampilkan surat masuk
    $query = "SELECT * FROM  tb_mail_in ORDER BY id_mail_in DESC";
    $result_vi = $fungsi->view($query);
    $result_ex = $fungsi->execute($query);
    $numrows = mysqli_num_rows($result_ex);
    $rowMail = mysqli_fetch_array($result_ex);


    
    //Query untuk delete surat masuk
    if(isset($_GET['delete'])){
        error_reporting(0);
        $nama_table = 'tb_mail_in';
        $id = $_GET['delete'];
        $key = "id_mail_in='$id'";

        $query_d = "SELECT * FROM tb_mail_in WHERE id_mail_in = '$id'";
        $result_un = $fungsi->execute($query_d);
        $data = mysqli_fetch_array($result_un);
        unlink("././mc-userfiles/Incoming Mail/$data[file_upload]");

        $result_del = $fungsi->delete($nama_table, $key);

        if($result_del) {
            echo "<script>
                window.location.href = 'index.php?page=incoming-mail';
            </script>";
        } else {
            echo "<script>alert('Data surat masuk gagal dihapus.'); window.location.href = 'index.php?page=incoming-mail'</script>";
        }
       
    }

    
?>

<title>Incoming Mail
    <?php echo $title; ?>
</title>

<!-- Modal -->
<div class="mc-modal animate show" id="modal">
    <div class="mc-modal-content">
        <div class="close-button">
            <span onclick="document.getElementById('modal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="image-file">
            <div align="center">
                <img src="././mc-userfiles/Incoming Mail/<?php echo $row['file_upload']; ?>" alt="<?php echo $row['file_upload']; ?>" title="<?php echo $row['file_upload']; ?>">
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->



<div class="incoming-mail"  style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Incoming Mail</h1>
        </div>
        <?php 
            //Jika data kosong
            if($numrows > 0) { 
        ?>

        <div class="header-top">
            <?php if($admin || $receptionist){ ?>
            <div class="new-box">
                <button class="add-incoming-mail" onclick="window.location.href='index.php?page=incoming-mail-new'">Add New</button>
            </div>
            <?php } ?>

            <!-- Search box -->
            <div class="search-box">
                <?php if($admin || $receptionist){ ?>
                <div class="print-mail display">
                    <a target="_blank" href="index.php?page=incoming-mail-print">
                        <i class="fa fa-print"></i> Print</a>
                </div>
                <?php } ?>
                <div class="search display">
                    <input type="search" onkeyup="search()" name="search" id="search" placeholder="Search incoming mail">
                </div>
            </div>
            <!-- End search box -->
        </div>



        <div class="mail-section">
            <table class="mc-table">
                <thead>
                    <tr>
                        <th width="20%">Mail code</th>
                        <th>Mail from</th>
                        <th>Date of incoming mail</th>
                        <th width="25%">Short description</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table_filter">
                    <?php foreach($result_vi as $key => $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row['mail_code']; ?>
                            <div class="row-actions">
                                <?php 
                                    if($_SESSION['level'] == 1){
                                ?>
                                <span class="edit">
                                    <a href="index.php?page=incoming-mail-edit&mail=<?php echo $row['id_mail_in']; ?>">Edit</a>
                                    <span style="color: #e0e0e0">| </span>
                                </span>
                                <span class="disposition">
                                    <a href="index.php?page=mail-disposition&mail-disposition=<?php echo $row['id_mail_in']; ?>">Disposition</a>
                                    <span style="color: #e0e0e0">|</span>
                                </span>
                               
                                <span class="trash">
                                    <a onclick="return confirm('Are you sure you want to delete this?')" href="index.php?page=incoming-mail&delete=<?php echo $row['id_mail_in']; ?>">Delete
                                    </a>
                                </span>
                                <?php } ?>

                                <?php 
                                    if($_SESSION['level'] == 2){
                                ?>
                                <span class="edit">
                                    <a href="index.php?page=incoming-mail-edit&mail=<?php echo $row['id_mail_in']; ?>">Edit</a>
                                    <span style="color: #e0e0e0">| </span>
                                </span>
                                <?php 
                                     if($row['status'] == 0){
                                        echo "";
                                    } else {
                                ?>
                                <span class="disposition">
                                    <a href="index.php?page=mail-disposition&mail-disposition=<?php echo $row['id_mail_in']; ?>">Disposition</a>
                                    <span style="color: #e0e0e0">|</span>
                                </span>
                                <?php } ?>

                                <span class="trash">
                                    <a onclick="return confirm('Are you sure you want to delete this?')" href="index.php?page=incoming-mail&delete=<?php echo $row['id_mail_in']; ?>">Delete
                                    </a>
                                </span>
                                <?php } ?>

                                <?php 
                                    if($_SESSION['level'] == 3){
                                ?>
                                <span class="disposition">
                                    <a href="index.php?page=mail-disposition&mail-disposition=<?php echo $row['id_mail_in']; ?>">Disposition</a>
                                </span>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <?php echo $row['mail_from']; ?>
                        </td>
                        <td>
                        <?php 
                            $tgl = $widget->date($row['incoming_at']);
                        ?>
                            <?php echo $tgl; ?>
                        </td>
                        <td>
                            <?php echo substr($row['mail_description'],0,150); ?>
                        </td>
                        <td>
                            <?php 
                                if($row['status'] == 0){
                                    $mailStatus = "Haven't disposition";
                                }
                                else if($row['status'] == 1){
                                    $mailStatus = "Already in disposition";
                                }
                            ?>
                            <?php echo $mailStatus; ?>
                        </td>
                        <td>
                            <button onclick="window.location.href='index.php?page=incoming-mail-detail&incoming-mail-detail=<?php echo $row['id_mail_in'] ?>'" type="button" class="button modal-show">Detail</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <?php 
            } 
            else {
        ?>
        <div class="mc-data-empty" style="margin-bottom: 4em;">
            <div class="data-empty-content">
                <h2>No data yet</h2>
                <p>When you create an incoming mail or ad, it'll show up here.</p>
                <p class="add-new">
                    <button type="submit" class="btn-create" onclick="window.location.href='index.php?page=incoming-mail-new'">Create incoming mail</button>
                </p>
            </div>
        </div>

        <?php
            }
        ?>
    </div>
</div>