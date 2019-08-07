<?php
    $query = "SELECT * FROM tb_mail_in ORDER BY id_mail_in ASC";
    $result = $fungsi->execute($query);
    $view_all = $fungsi->view($query);
    $count = mysqli_num_rows($result);
?>

    <style>
        .mc-navbar,
        .mc-footer {
            display: none;
        }
    </style>

    <?php 
        $date = $widget->date(date('Y-m-d'));
    ?>
    <title>Incoming Mail Print at: <?php echo $date ?></title>

    <div class="incoming-mail-print">
        <div class="mc-container">
            <div class="heading-title">
                <h1>All Incoming Mail</h1>
            </div>

            <div class="print-section">
                <button onclick="print()" class="btn-print" ><span class="fa fa-print"></span> Print</button >
                <p>&nbsp;</p>
            </div>

            <div class="incoming-mail-print-content">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th>Mail from</th>
                            <th>Mail code</th>
                            <th>Incoming at</th>
                            <th>Mail created</th>
                            <th>Subject</th>
                            <th>Mail to</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th width="25%">Short description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($view_all as $key => $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row['mail_from']; ?>
                            </td>
                            <td>
                                <?php echo $row['mail_code']; ?>
                            </td>
                            <td>
                                <?php 
                                        $incomingdate = $widget->date($row['incoming_at']);
                                    ?>
                                <?php echo $incomingdate; ?>
                            </td>
                            <td>
                                <?php 
                                        $created = $widget->date($row['mail_date']);
                                    ?>
                                <?php echo  $created; ?>
                            </td>
                            <td>
                                <?php echo $row['mail_subject']; ?>
                            </td>
                            <td>
                                <?php echo $row['mail_to']; ?>
                            </td>
                            <td>
                                <?php 
                                    if($row['id_mail_type'] == 1){
                                        $typeMail = 'Invitation';
                                    } else if ($row['id_mail_type'] == 2){
                                        $typeMail = 'Official';
                                    }
                                ?>
                                <?php echo $typeMail; ?>
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
                                <?php echo substr($row['mail_description'],0,150); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="table-navbottom">
                    <span><?php echo $count ?> item</span>
                </div>
            </div>
        </div>
    </div>