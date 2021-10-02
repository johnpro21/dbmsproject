<!DOCTYPE html>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Resource Management</title>
    <style>
    Body {
          font-family: Calibri, Helvetica, sans-serif;
    }
    .navbar{
        width: 100%;
        background-color: #034c81;
        color: whitesmoke;
        height: 50px;
        display: flex;
        flex-direction: row;
    }
    .banner{
        width: 90%;
        height: auto;
        text-align: left;
        padding-left: 10px;
    }
    .acc_name{
        width: auto;
        background-color:#034c81;
        border-color: 3px solid black;
        padding: 6px;
        display: flex;
        flex-direction: row;
    
    } 
    .select{
        width: auto;
        max-width: 80px;
        border-radius: 20px;
        border-color:3px solid black;
        background-color: #034c81;
    }
    .select::backdrop{
        width: auto;
        border-radius: 30px;
        border-color:3px solid black;
        background-color: #034c81;
    }
    .option{
        width: auto;
    }
    .acc{
        width: fit-content;
        border-radius:20px;
        border: 3px solid whitesmoke;
        background-color: #034c81;
        color: whitesmoke;
        padding-bottom: 10px;
        margin-left: 20px;
        display: flex;
        flex-direction: row;
    }
    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
    .h2{
        margin:0px;
        size: 18px;
        color:red;
    }
    }
    .body{
        width: 100%;
        height:auto;
        display: flexbox;
        flex-direction: column;
    }
    .my_req{
        height:fit-content;
    }
    .req_near{
        height: 50%;
    }
    </style>
</head>
<body>
<?php
    $l="localhost";
    $u="root";
    $p="";
    $dp="dbms_project";
    $con=mysqli_connect($l,$u,$p,$dp);
    if(!$con)
    {
        die("Not connected:" . mysqli_connect_error());
    }
    session_start();
    //echo "uid:",$_SESSION['uid'];
    $uid=$_SESSION['uid'];
    //echo $uid;
    $query1="SELECT * from users where uid='{$uid}'";
    $result1=mysqli_query($con,$query1)or die("Bad code:'{$query1}'");
    $curr_user=mysqli_fetch_assoc($result1);
    //print_r($curr_user)
    ?>
    <div class="navbar">
        <div class="banner">
        <h2> Hospital Resource Management</h2>
        </div>
        <div class="acc_name">
        <select name="h_name">
            <?php
                $q2="SELECT * from hos_name";
                $res2=mysqli_query($con,$q2) or die ("Hospital Name");
                
                while($h_name=mysqli_fetch_array($res2))
                {
                    ?>
                        <option value="<?php echo $h_name['hos_name'];?>"><?php echo $h_name['hos_name'];?></option>
                    <?php
                }
            ?>
        </select>
        <button class="acc" on>
            <img src="http://localhost/dbms_project_grp2/images/acc_icon.png" style="margin-top:2px;height:25px; width:auto;">
            <p style="margin-left:3px;margin-top:1px;"><?php
            echo $curr_user['name'];
            ?>
            </p>
         </button>
        </div>
    </div>
    <div class="body">
        <div class="my_req"></div>
        <div class="req_near"></div>
    </div>
</body>
