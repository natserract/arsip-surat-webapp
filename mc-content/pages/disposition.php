<?php 
    //Query for v_mail_in & v_disposition
    $queryMail = "SELECT * FROM view_disposition";
    $resultMail = $fungsi->execute($queryMail);
    $viewMail = $fungsi->view($queryMail);
    $numrows = mysqli_num_rows($resultMail);

?>



<title>Disposition
    <?php echo $title; ?>
</title>

<!-- Modal -->
<div class="mc-modal animate show" id="modal">
    <div class="mc-modal-content">
        <div class="close-button">
            <span onclick="document.getElementById('modal').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="image-file">
            <div align="center">
                <img src="././mc-userfiles/Incoming Mail/<?php echo $rowMail['file_upload']; ?>" alt="<?php echo $rowMail['file_upload']; ?>"
                    title="<?php echo $rowMail['file_upload']; ?>">
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->
<div class="disposition-all" style="padding-bottom: 12em">
    <div class="mc-container">

        <div class="header-top">
            <div class="heading-title">
                <h1>Disposition</h1>
            </div>
        
        <?php 
            if($numrows > 0 ){
         ?>
            <!-- Search box -->
            <div class="search-box">
                <input type="search" onkeyup="search()" name="search" id="search" placeholder="Search disposition">
            </div>
            <!-- End search box -->
        </div>
        

        <table class="mc-table">
            <thead>
                <tr>
                    <th>Mail code</th>
                    <th>Mail from</th>
                    <th>Date of incoming mail</th>
                    <th>Disposition to</th>
                    <th>Disposition type</th>
                </tr>
            </thead>
            <tbody id="table_filter">
                <?php foreach($viewMail as $key => $row) { ?>
                <tr>
                    <td>
                        <?php echo $row['mail_code']; ?>
                        <div class="row-actions">
                            <?php 
                                if($admin || $leader){
                            ?>
                            <span class="edit">
                                <a href="index.php?page=disposition-edit&disposition-edit=<?php echo $row['id_disposition']; ?>&mail=<?php echo $row['id_mail_in'] ?>">Edit</a>
                                <span style="color: #e0e0e0">| </span>
                            </span>
                            <span class="trash">
                                <a onclick="return confirm('Are you sure you want to delete this?')" href="index.php?page=disposition-delete&delete=<?php echo $row['id_mail_in']; ?>&mail=<?php echo $row['id_mail_in'] ?>">Delete
                                </a>
                            </span>
                            <?php } ?>
                    </td>
                    <td><?php echo $row['mail_from'] ?></td>
                    <?php 
                                $tgl = $widget->date($row['incoming_at']);
                            ?>
                    <td>
                        <?php echo $tgl; ?>
                    </td>
                    <td>
                        <?php echo $row['reply_at']; ?>
                    </td>
                    <td>
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
                        <?php echo $typeDisposition; ?>
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
                        <button type="submit" class="btn-create" onclick="window.location.href='index.php?page=incoming-mail'">Create disposition</button>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>