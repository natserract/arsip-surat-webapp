<?php
    $mailId = $_GET['mail-print'];
    $dispositionId = $_GET['mail-disposition'];
    $query = "SELECT * FROM view_disposition WHERE id_mail_in = ' $mailId'";    
    $result = $fungsi->view($query);
    $exec = $fungsi->execute($query);
    $count = mysqli_num_rows($exec);

    if($leader){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }
?>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
            window.close();
        }
    </script>

    <style>
        .mc-navbar,
        .mc-footer {
            display: none;
        }
    </style>

    <div class="mail-disposition-print">
        <div class="mc-container">
            <div class="heading-title inline-block">
                <h1>Mail Disposition</h1>
            </div>

            <div class="mail-disposition-content">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th>Mail code</th>
                            <th>Mail from</th>
                            <th>Incoming at</th>
                            <th>Disposition to</th>
                            <th width="25%">Disposition description</th>
                            <th>Disposition type</th>
                            <th>Disposition date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $key => $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row['mail_code'] ?>
                            </td>
                            <td>
                                <?php echo $row['mail_from']  ?>
                            </td>
                            <td>
                                <?php   
                                    $dateincoming = $widget->date($row['incoming_at']);
                                ?>
                                <?php echo $dateincoming;  ?>
                            </td>
                            <td>
                                <?php echo $row['reply_at'] ?>
                            </td>
                            <td>
                                <?php echo substr($row['description'],0,150) ?>
                            </td>
                            <td>
                                <?php 
                                    if($row['notification'] == 1){
                                        $type = "Important";
                                    } else if($row['notification'] == 2){
                                        $type = "Soon";
                                    }  else if($row['notification'] == 3){
                                        $type = "Secret";
                                    }
                                ?>
                                <?php echo  $type ?>
                            </td>
                            <td>
                                <?php 
                                    $dispositionDate = $widget->date($row['incoming_at']);
                                ?>
                                <?php echo $dispositionDate ?>
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