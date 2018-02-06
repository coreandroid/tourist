<?php

include 'conn.php';


mysqli_query($conn,"delete from spots where Id=$_GET[Id]");

header("location:spot.php");

?>