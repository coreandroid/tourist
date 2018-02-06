<?php

include 'conn.php';


mysqli_query($conn,"delete from Users where Id=$_GET[Id]");

header("location:user.php");

?>