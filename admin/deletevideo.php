<?php

include("../database/Db_conection.php");
$delete_id=$_GET['del'];
$delete_query="delete  from videos WHERE id='$delete_id'";//delete query
$run=mysqli_query($dbcon,$delete_query);
if($run)
{
//javascript function to open in the same window
    echo "<script>window.open('videolist.php','_self')</script>";
}

?>