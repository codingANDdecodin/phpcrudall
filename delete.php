<?php
 
 if(isset($_GET['id'])){
    $id=$_GET['id'];
 }

 $servername='localhost';
 $username='root';
 $passward='';
 $database='myshop';

 $connection=new mysqli($servername,$username,$passward,$database);

 $sql= "DELETE FROM clients WHERE id=$id";
 $connection->query($sql);

 header('location:/PHPWORK/index.php');

?>