
<?php 
    $title = " &lsaquo; Mailchips | Mail Archiving";

    //Connect to database
    class Connection {
        public function __construct(){
            $this->connect = new mysqli("localhost", "k8242757_admin", "Alfin9090", "k8242757_mailchips");
        }
        public function execute($query){
            $executed = $this->connect->query($query);
            return $executed;
        }
    }

    //Create, read, update, delete
    class Databases extends Connection {
        //Insert to database
        public function post($table, $field, $values){
            $query = "INSERT INTO $table($field) VALUES ($values) ";
            $result = $this->execute($query);

            if($result == false){
                echo mysqli_error($this->connect);
                return false;
            } else {
                return true;
            }
        }

        //Insert to database with upload file
        public function postWFile($table, $field, $values, $files){
            $allVal = $values.$files;

            $filesEmpty = "'-'";
            $allValEmpty = $values.$filesEmpty;

            if($files == "''"){
                $query = "INSERT INTO $table($field) VALUES ($allValEmpty)";
            } else {
                $query = "INSERT INTO $table($field) VALUES ($allVal)";
            }

            $result = $this->execute($query);

            if($result == false){
                echo mysqli_error($this->connect);
                return false;
            } else {
                return true;
            }
        }

        //Update to database
        public function update($table, $set, $key){
            $query = "UPDATE $table SET $set WHERE $key";

            $result = $this->execute($query);
            if($result == false){
                echo mysqli_error($this->connect);
                return false;
            } else {
                return true;
            }
        }

        //Update to database with upload file
        public function updateWFile($table, $set, $setWFile, $key, $checkFiles, $fileDelete){
            if($checkFiles == "''"){
                $query = "UPDATE $table SET $set WHERE $key";
            } else {
                $query = "UPDATE $table SET $setWFile WHERE $key";
                
                if(file_exists($fileDelete)){
                    unlink($fileDelete);
                }
            }

            $result = $this->execute($query);
            
            if($result == false) {
                echo mysqli_error($this->connect);
                return false;
            } else {
                return true;
            }
        }

        //Delete data
        public function delete($table, $key){
            $query = "DELETE FROM $table WHERE $key";

            $result = $this->execute($query);
            if($result == false){
                echo mysqli_error($this->connect);
                return false;
            } else {
                return true;
            }
        }
        
        //View data
        public function view($query){
            $result = $this->connect->query($query);
    
            if($result == false){
                return false;
            }
    
            $rows = array();
    
            while ($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
    }

    //Using backup & restore data
    class Maintenance extends Connection {
        //Backup database
        public function backupDatabase($username, $database, $path){
            $backup = 'C:/xampp/mysql/bin/mysqldump -u '.$username.' '.$database.' > '.$path.'';
            $hasil = exec($backup);
        }
        //Restore database
        public function restoreDatabase($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
        
            $templine = '';
            
            $lines = file($filePath);
            
            $error = '';
        
            // Loop through each line
            foreach ($lines as $line){
                if(substr($line, 0, 2) == '--' || $line == ''){
                    continue;
                }
                $templine .= $line;
                
                if (substr(trim($line), -1, 1) == ';'){
                    if(!$db->query($templine)){
                        $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
                    }
                    $templine = '';
                }
            }
            return !empty($error)?$error:true;
        }
    }
    

    //Using another
    class Widget extends Connection {
        //View Date
        public function date($date) {
            $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
        $split = explode('-', $date);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        }

    }

   
?>