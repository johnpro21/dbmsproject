<?php
include ("session.php");
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $reqster_h_name = $_GET['h_name'];
    // inserting into resource_rqst
    $add_query = "DELETE FROM resource_rqst WHERE reqster_uid=$uid AND resourse_id=$id;";
    $add_result=mysqli_query($db_connect,$add_query);
    if($add_result)
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