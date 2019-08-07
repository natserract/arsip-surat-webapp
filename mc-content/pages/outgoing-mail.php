<?php 
    //Query untuk menampilkan surat keluar
    $query = "SELECT * FROM tb_mail_out ORDER BY id_mail_out DESC";
    $result_vi = $fungsi->view($query);
    $result_ex = $fungsi->execute($query);
    $numrows = mysqli_num_rows($result_ex);
    $rowMail = mysqli_fetch_array($result_ex);

    //Query untuk delete surat masuk
    if(isset($_GET['delete'])){
        $table = 'tb_mail_out';
        $id = $_GET['delete'];
        $key = "id_mail_out='$id'";

        $query_d = "SELECT * FROM tb_mail_out WHERE id_mail_out = '$id'";
        $result_un = $fungsi->execute($query_d);
        $data = mysqli_fetch_array($result_un);
        unlink("././mc-userfiles/Outgoing Mail/$data[file_upload]");

        $result_del = $fungsi->delete($table, $key);
        
        if($result_del) {
            echo "<script>window.location.href = 'index.php?page=outgoing-mail'</script>";
        } else {
            echo "<script>alert('Data surat masuk gagal dihapus.'); window.location.href = 'index.php?page=outgoing-mail'</script>";
        }
    }
    
?>




<title>Outgoing Mail
    <?php echo $title; ?>
</title>



<div class="outgoing-mail" style="margin-bottom: 8em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Outgoing Mail</h1>
        </div>

        <?php 
            //Jika data kosong
            if($numrows > 0) { 
        ?>

        <div class="header-top">
            <?php if($admin || $receptionist){ ?>
            <div class="new-box">
                <button class="add-incoming-mail" onclick="window.location.href='index.php?page=outgoing-mail-new'">Add New</button>
            </div>
            <?php } ?>
            <!-- Search box -->
            <div class="search-box">
                <?php if($admin || $receptionist){ ?>
                <div class="print-mail display">
                    <a target="_blank" href="index.php?page=outgoing-mail-print">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
                <?php } ?>
                <div class="search display">
                    <input type="search" onkeyup="search()" name="search" id="search" placeholder="Search outgoing mail">
                </div>
            </div>
            <!-- End search box -->
        </div>


        <div class="mail-section">
            <form action="" method="POST">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th>Mail code</th>
                            <th>Mail to</th>
                            <th>Date of mail created</th>
                            <th width="30%">Description</th>
                            <th>Subject</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_filter">
                        <?php foreach($result_vi as $key => $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row['mail_code']; ?>
                                <?php if($admin || $receptionist){ ?>
                                <div class="row-actions">
                                    <span class="edit" style="color: #e0e0e0">
                                        <a href="index.php?page=outgoing-mail-edit&mail=<?php echo $row['id_mail_out']; ?>">Edit</a> | </span>
                                    <span class="trash" style="color: #e0e0e0">
                                        <a onclick="return confirm('Are you sure want to delete this?')" href="index.php?page=outgoing-mail&delete=<?php echo $row['id_mail_out']; ?>">Delete</a>
                                    </span>
                                </div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $row['mail_to']; ?>
                            </td>
                            <?php 
                                $date = $widget->date($row['mail_date']);
                            ?>
                            <td>
                                <?php echo $date; ?>
                            </td>
                            <td class="description">
                                <?php echo substr($row['mail_description'],0,100); ?>
                            </td>
                            <td>
                                <?php echo $row['mail_subject'] ?>
                            </td>
                            <td>
                                <button type="button" class="button modal-show" onclick="window.location.href='index.php?page=outgoing-mail-detail&outgoing-mail-detail=<?php echo $row['id_mail_out']; ?>'">Detail</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
        <?php 
            } 
            else {
        ?>
        <div class="mc-data-empty">
            <div class="data-empty-content">
                <h2>No data yet</h2>
                <?php if($admin || $receptionist){ ?>
                <p>When you create an outgoing mail or ad, it'll show up here.</p>
                <p class="add-new">
                    <button type="submit" class="btn-create" onclick="window.location.href='index.php?page=outgoing-mail-new'">Create outgoing mail</button>
                </p>
                <?php } ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>