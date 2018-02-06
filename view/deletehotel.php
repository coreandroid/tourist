<?php

include 'conn.php';


mysqli_query($conn,"delete from hotels where Id=$_GET[Id]");

header("location:hotel.php");

?>