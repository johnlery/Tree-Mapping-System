<?php
    /* Database connection */
    include_once 'db_con.php';
    if(isset($_POST['id'])&&isset($_POST['table'])){
        
        $id = $_POST['id'];
        $table = $_POST['table'];
        $sql = "DELETE FROM '$table' WHERE user_id = '$id'";
        $result = mysql_query($sql);
        if (!$result) {
            # code...
            die("asd");
        }

        echo $id;
    } else { 
        echo '0'; 
    }
?>