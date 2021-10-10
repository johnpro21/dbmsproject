<?php
include ("session.php");
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = $_SESSION['uid'];
    $query1="DELETE FROM ";
    if($result)
    {
        header("location:index.php?h_name=$reqster_h_name&tab=1");
    }
    else{
        echo("An Error Occured");
    }
    
    
}
else{
    echo("An Error Occured");
}
?>