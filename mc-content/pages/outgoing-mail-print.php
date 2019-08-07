<?php
    $query = "SELECT * FROM tb_mail_out ORDER BY id_mail_out ASC";
    $result = $fungsi->execute($query);
    $view_all = $fungsi->view($query);
    $count = mysqli_num_rows($result);

    if($leader){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }
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

    <title>Outgoing Mail Print at : <?php echo $date  ?></title>

    <div class="outgoing-mail-print">
        <div class="mc-container">
            <div class="heading-title">
                <h1>All Outgoing Mail</h1>
            </div>

            <div class="print-section">
                <button onclick="print()" class="btn-print" ><span class="fa fa-print"></span> Print</button >
                <p>&nbsp;</p>
            </div>

            <div class="outgoing-mail-print-content">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th>Mail code</th>
                            <th>Mail to</th>
                            <th>Mail created</th>
                            <th>Subject</th>
                            <th width="23%">Short description</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($view_all as $key => $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row['mail_code']; ?>
                            </td>
                            <td>
                                <?php echo $row['mail_to']; ?>
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
                                <?php echo substr($row['mail_description'],0,150); ?>
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