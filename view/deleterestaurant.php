<?php

include 'conn.php';


mysqli_query($conn,"delete from restaurants where Id=$_GET[Id]");

header("location:restaurant.php");

?>