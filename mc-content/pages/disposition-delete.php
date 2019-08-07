
<?php 
    $mail = $_GET['mail'];
    $delete = $_GET['delete'];

    $nama_table = "tb_disposition";
    $key = "id_disposition='$delete'";

    $result = $fungsi->delete($nama_table, $key);

    if($result){
        echo "<script>window.location.href='index.php?page=disposition'</script>";
    }

    if($receptionist){
        echo "<script>window.location.href='index.php?page=404'</script>";
    }
?>