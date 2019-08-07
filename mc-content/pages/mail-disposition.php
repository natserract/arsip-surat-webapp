<?php 
    
    $id = $_GET['mail-disposition'];
    $query = "SELECT * FROM tb_mail_in WHERE id_mail_in = '$id'";
    $result = $fungsi->execute($query);
    $data = mysqli_fetch_array($result);
   

    //Disposition Query
    $query_disposition = "SELECT * FROM tb_disposition WHERE id_mail_in = '$id'";
    $result_disposition = $fungsi->execute($query_disposition);
    $view_disposition = $fungsi->view($query_disposition);
    $numrows = mysqli_num_rows($result_disposition);
    $dataDisposisi = mysqli_fetch_array($result_disposition);

    if($_SESSION['level'] == 2){
        if($data['status'] == 0){
            echo "<script>alert('Sorry letter has not been in disposition'); window.location.href = 'index.php?page=incoming-mail'</script>";
        }
    }

?>

<title>Mail Disposition
    <?php echo $title; ?>
</title>

<div class="disposition" style="padding-bottom: 15em">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Mail Disposition</h1>
        </div>

        <div class="disposition-section">
            <?php 
                //Jika data kosong
                if($numrows > 0) { 
            ?>
            <div class="header-top">
                    
                <!-- Search box -->
                <div class="search-box">
                    <?php
                        if($admin || $receptionist){
                    ?>
                    <div class="print-mail display">
                        <a target="_blank" href="index.php?page=mail-disposition-print&mail-print=<?php echo $id ?>&mail-disposition=<?php echo $dataDisposisi['id_disposition'] ?>">
                            <i class="fa fa-print"></i> Print</a>
                    </div>
                    <?php } ?>
                    <div class="search display">
                        <input type="search" onkeyup="search()" name="search" id="search" placeholder="Search disposition">
                    </div>
                </div>
                <!-- End search box -->
            </div>
        </div>

        <table class="mc-table">
            <thead>
                <tr>
                    <th>Disposition to</th>
                    <th>Disposition date</th>
                    <th width="30%">Description</th>
                    <th>Disposition type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table_filter">
                <?php foreach($view_disposition as $key => $row) { ?>
                <tr>
                    <td>
                        <?php echo $row['reply_at'] ?>
                        <div class="row-actions">
                            <?php 
                                if($admin || $leader){
                            ?>
                            <span class="edit">
                                <a href="index.php?page=mail-disposition-edit&mail-disposition-edit=<?php echo $row['id_disposition']; ?>&mail-disposition=<?php echo $id; ?>">Edit</a>
                                <span style="color: #e0e0e0">| </span>
                            </span>

                            <span class="trash">
                                <a onclick="return confirm('Are you sure you want to delete this?')" href="index.php?page=mail-disposition-delete&mail-disposition-delete=<?php echo $row['id_disposition'] ?>&mail-disposition=<?php  echo $id; ?>">Delete
                                </a>
                            </span>
                            <?php }  ?>
                        </div>
                    </td>
                    
                    <td>
                    <?php 
                            $date = $widget->date($row['disposition_at']);
                        ?>
                        <?php echo $date; ?>
                    </td>

                    <td>
                        <?php echo substr($row['description'],0,100); ?>
                    </td>
                    <?php
                                if($row['notification'] == 1){
                                    $typeDisposition = 'Important';
                                } 
                                else if($row['notification'] == 2){
                                    $typeDisposition = 'Soon';
                                }
                                else if($row['notification'] == 3){
                                    $typeDisposition = 'Secret';
                                }
                                
                            ?>
                        <td>
                            <?php echo  $typeDisposition; ?>
                        </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <div class="mc-data-empty">
            <div class="data-empty-content">
                <h2>No data yet</h2>
                <p>When you create an disposition or ad, it'll show up here.</p>
                <p class="add-new">
                    <button type="submit" class="btn-create" onclick="window.location.href='index.php?page=mail-disposition-new&mail-disposition-new=<?php echo $data['id_mail_in']; ?>'">Create disposition</button>
                </p>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>
</div>