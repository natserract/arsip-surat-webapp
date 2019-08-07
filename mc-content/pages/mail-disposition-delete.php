
<?php 
    if($receptionist){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }

    $mailId = $_GET['mail-disposition'];
    $disposisiId = $_GET['mail-disposition-delete'];
    $nama_table = "tb_disposition";
    $key = "id_disposition='$disposisiId'";

    $result_del = $fungsi->delete($nama_table, $key);

    if($result_del){
?>
    <script>window.location.href="index.php?page=mail-disposition&mail-disposition=<?php echo $mailId ?>"</script>";
<?php
    } else {
        echo "<script>alert('Gagal delete data');</script>";
    }

?>