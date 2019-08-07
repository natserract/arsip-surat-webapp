
<?php
    $maildetail = $_GET['incoming-mail-detail'];
    $query = "SELECT * FROM  tb_mail_in WHERE id_mail_in = '$maildetail'";
    $result = $fungsi->execute($query);
    $row = mysqli_fetch_array($result);

    $file = $row['file_upload'];
    $convert = explode(".", $file);
    $eks = end($convert);
    $target_dir = "././mc-userfiles/Incoming Mail/";
?>

<title>Incoming Mail Detail <?php echo $title; ?></title>

<!-- Modal -->
<div class="mc-modal animate" id="modal">
    <div class="mc-modal-content">
        <div class="close-button">
            <span onclick="document.getElementById('modal').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="image-file">
            <div align="center">
                <img src="././mc-userfiles/Incoming Mail/<?php echo $row['file_upload']; ?>" alt="<?php echo $row['file_upload']; ?>"
                    title="<?php echo $row['file_upload']; ?>">
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->

<div class="incoming-mail-detail" style="margin-bottom: 7em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Incoming Mail Detail</h1>
        </div>

        <?php if($admin || $receptionist){ ?>
            <div class="print-section">
                <a target="_blank" href="index.php?page=incoming-mail-detail-print&mail-print=<?php echo $row['id_mail_in'] ?>" class="btn-print" ><span class="fa fa-print"></span> Print</a  >
            </div>
        <?php } ?>

        <div class="mail-detail-section">
                <div class="mail-detail-content">
                    <ul class="detail">
                        <li>
                            <h3>Mail from:</h3>
                            <p><?php echo $row['mail_from']; ?></p>
                        </li>
                        <li>
                            <h3>Mail code:</h3>
                            <p><?php echo $row['mail_code'];  ?></p>
                        </li>
                        <li>
                            <?php
                                $dateIncoming = $widget->date($row['incoming_at']);
                            ?>
                            <h3>Date of incoming mail:</h3>
                            <p><?php echo $dateIncoming;  ?></p>
                        </li>

                        <li>
                            <?php
                                $dateCreated = $widget->date($row['mail_date']);
                            ?>
                            <h3>Date of mail created:</h3>
                            <p><?php echo $dateCreated;  ?></p>
                        </li>
                        <li>
                            <h3>Subject:</h3>
                            <p><?php echo $row['mail_subject'];  ?></p>
                        </li>
                        <li>
                            <h3>Mail type:</h3>
                            <?php 
                                if($row['id_mail_type'] == 1){
                                    $type = "Invitation";
                                } else if($row['id_mail_type'] == 2){
                                    $type = "Official";
                                }
                            ?>
                            <p><?php echo $type;  ?></p>
                        </li>
                        <li>
                            <h3>Short description:</h3>
                            <p><?php echo $row['mail_description'];  ?></p>
                        </li>
                        <li>
                            <h3>File:</h3> 
                            <p>
                                <?php 
                                    if($eks == "pdf"){ 
                                ?>
                                    <a href="<?php echo $target_dir.$file ?>" target="_blank" title="Show File"><?php echo $row['file_upload'];  ?>
                                    </a>
                                <?php 
                                } else {
                                ?>
                                <a href="javascript:;" onclick="showModal()" title="Show File"><?php echo $row['file_upload'];  ?></a>
                                <?php } ?>
                            </p>
                        </li>
                    </ul>
                    <div class="back-to">
                        <button class="go-back" onclick="window.history.back()"><span class="fa fa-angle-double-left"></span> Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

