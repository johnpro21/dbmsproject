<?php
include ("session.php");
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $description = $_POST['description'];
    $resource_type = $_POST['resource_type'];
    $quantity = $_POST['quantity'];
    $reqster_name = $_POST['reqster_name'];
    $reqster_phno = $_POST['reqster_phno'];
    $reqster_uid = $_POST['reqster_uid'];
    $reqster_h_name = $_POST['reqster_h_name'];
    $add_query = "INSERT INTO resource_rqst (description,quantity,resource_type,reqster_name,reqster_phno,reqster_uid,reqster_h_name) VALUES ('$description','$quantity','$resource_type','$reqster_name','$reqster_phno','$reqster_uid','$reqster_h_name');";
    $add_result=mysqli_query($db_connect,$add_query);
    if($add_result)
    {
        header("location:index.php?h_name=$reqster_h_name");
    }
    else{
        echo("An Error Occured");
    }
    
    
}
else{
    echo("An Error Occured");
}
?>