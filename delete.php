

<?php
    include "connect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM clients where id = $id";
        $conn->query($sql);
    
    }
        header("Location:index.php");
        exit;
    
?>