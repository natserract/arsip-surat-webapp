
<?php
    
        $id = $_GET['mail-disposition-new'];
        $query = "SELECT * FROM tb_mail_in WHERE id_mail_in = '$id'";
        $result = $fungsi->execute($query);
        $data = mysqli_fetch_array($result);

        if($receptionist){
            echo "<script>window.location.href='index.php?page=404'</script>";
        }

        if(isset($_POST['save'])){
            //Get name
            $dispositionTo = $_POST['disposition-to'];
            $dispositionDate = date('Y-m-d');
            $dispositionType = $_POST['disposition-type'];
            $dispositionKet = $_POST['disposition-ket'];

            //Disposition status
            $dispositionStatus = 1;

            //Get id mail
            $mailId = $_GET['mail-disposition-new'];

            //Get id user
            $userId = $_SESSION['level'];

            //Call
            $table = "tb_disposition";
            $field = 'reply_at, disposition_at, notification, description, status, id_mail_in, id_user';
            $values = "'$dispositionTo','$dispositionDate','$dispositionType', '$dispositionKet', '$dispositionStatus', '$mailId', '$userId'";

            $result = $fungsi->post($table, $field, $values);

            if($result) {
?>
            <script>window.location.href='index.php?page=mail-disposition&mail-disposition=<?php echo $data['id_mail_in']; ?>'</script>
          
<?php 
                    }

            }
?>


<title>Add New Mail Disposition <?php echo $title; ?></title>

<div class="mail-disposition-new" style="padding-bottom: 10em;">
    <div class="mc-container">
        <div class="heading-title">
            <h1>Add New Mail Disposition</h1>
        </div>

        <form action="" method="post" class="form-label">
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="dispositionto">Disposition to</label>
                            <input type="text" name="disposition-to"  class="focus" required="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="disposition-ket">Short Description</label>
                            <textarea name="disposition-ket" required="" maxlength="150"></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="unit">
                    <fieldset>
                        <div class="form-group">
                            <label for="dispositiontype">Disposition type</label>
                            <select name="disposition-type" required="">
                                <option value>Choose disposition type</option>
                                <option value="1">Important</option>
                                <option value="2">Soon</option>
                                <option value="3">Secret</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <p class="submit">
                    <input type="submit" name="save" value="Save">
                    <a href="index.php?page=mail-disposition&mail-disposition=<?php echo $data['id_mail_in']; ?>" class="btn-cancel">Cancel</a>
                </p>
            </form>
    </div>
</div>