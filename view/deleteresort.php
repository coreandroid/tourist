<?php

include 'conn.php';


mysqli_query($conn,"delete from resorts where Id=$_GET[Id]");

header("location:resort.php");

?>