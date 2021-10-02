<!DOCTYPE html>
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
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Resource Management</title>
    <script>
        function loadsignup(){
            location.href="/dbms_project_grp2/signup.php"
        }
    </script>
    <style> 
        Body {
          font-family: Calibri, Helvetica, sans-serif;
          background-color: whitesmoke;
        }
        button {
               width: 40%;
                padding: 15px 10px; 
                cursor: pointer; 
                 } 
         form { 
                margin-top: 7%;
                margin-left: 25%;
                margin-right: 25%;
                border-radius: 20px;
                border: 3px solid #034c81; 
            } 
            input[type=password],input[type=email] {
             border-radius: 20px;
                width: 100%; 
                margin: 8px 0;
                padding: 12px 20px; 
                display: inline-block; 
                border: 2px solid 	#2ca3fa; 
                box-sizing: border-box; 
            }
            input[type=password]:focus,input[type=email]:focus{
                border-radius: 20px;
                width: 100%; 
                margin: 8px 0;
                padding: 12px 20px; 
                display: inline-block; 
                border: 2px solid #034c81; 
                box-sizing: border-box; 
            }
         
            .btn1{
                border: 3px solid#5ba2f4;
                border-radius: 20px;
                color:#5ba2f4;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
                background-color:whitesmoke;
                
            }
            .btn1:hover{
                background-color: #5ba2f4;
                color: whitesmoke;
            }
            .btn2{
                border: none;
                background-color: whitesmoke;
                color: #5ba2f4;
                
                
            }
          .cancelbtn { 
                width: auto; 
                padding: 10px 18px;
                margin: 10px 5px;
            } 
              
          .Banner{
              width: 100%;
              background-color: #034c81;
              color: whitesmoke;
          } 
         .container { 
                margin: auto;
                align-content: center;
                border-radius: 20px;
                padding:20px; 
                background-color: whitesmoke;
            } 
        </style> 
</head>
<body>
    <div class="Banner"><h1> Hospital Resource Management</h1></div>
    <center> <h1>Login Form </h1> </center> 
    <form name="Loginform" method="post" >
        
        <div class="container"> 
            <label>Username : </label> 
            <input type="email" id="email" placeholder="Enter Email" name="email" required>
            <label>Password : </label> 
            <input type="password" id="password" placeholder="Enter Password" name="password" required>
            <button type="submit" id="submit" value="submit" class="btn1">Login</button>
            <p style="margin-left:auto; color:#034c81;">
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
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    $e = $_POST['email'];
                    $p = $_POST['password'];
                    $query = "select * from login where email = '$e' and password ='$p'";
                    $results = mysqli_query($con,$query);
                    $count = mysqli_num_rows($results);
                    if($count == 1)
                    {
                        $query3="SELECT * from login where email='{$e}'";
                        $r1=mysqli_query($con,$query3) or die("bad query!");
                        $uid=mysqli_fetch_array($r1);
                        echo($uid['user_id']);
                        $_SESSION['uid']=$uid['user_id'];
                        header('Location: home.php');
                    }
                    else
                    {   
                        
                        echo 'Invalid Details!!';
                    }
                    
                }
            ?>
            </p>
            <button type="button"  onclick="loadsignup()" class="btn2">Sign Up</button>

        </div> 
    </form>
</body>
</html>