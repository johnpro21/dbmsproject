<?php
include ("session.php");
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = $_SESSION['uid'];
    $name=$_POST['name'];
    $ph_no=$_POST['phoneno'];
    $pass=$_POST['password'];
    //calling Stored procedure updateAcc
    $query="CALL updateAcc('$uid','$name','$ph_no','$pass')";
    $result = mysqli_query($db_connect, $query);
    session_start();
    if($result)
    {
        //if profile updated setting value
        $_SESSION['status']="Your Profile Updated Succesfully";
        header("location:profile.php");
    }
    else{
        $_SESSION['status']="An Error Occured";
        
    }
    
    
}
else{
    $_SESSION['status']="An Error Occured";
}?>
