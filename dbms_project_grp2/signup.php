<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Resource Management</title>
    <script>
        function loadsignup(){
            location.href="/dbms_project_grp2/index.php"
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
         input[type=text], input[type=password],input[type=email],input[type=tel] { 
             border-radius: 20px;
                width: 100%; 
                margin: 8px 0;
                padding: 12px 20px; 
                display: inline-block; 
                border: 2px solid 	#2ca3fa; 
                box-sizing: border-box; 
            }
         button:hover { 
                opacity: 0.7;

            }
            .btn1{
                border: 3px solid#5ba2f4;
                border-radius: 20px;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
                color:#5ba2f4;
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
              padding: 0px;
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
    <div class="Banner"><h1>Hospital Resource Management</h1></div>
    <center> <h1>Sign Up Form </h1> </center> 
    <form name="signupform" method="post">
        
        <div class="container"> 
            <label>Name : </label> 
            <input type="text" id="username" placeholder="Enter Username" name="username" required>
            <label>Email :</label>
            <input type="email" id="email" placeholder="Enter Email" name="email" required>
            <label>Phone Number</label>
            <input type="tel" id="phoneno" placeholder="Enter Phone Number" name="phoneno" required>
            <label>Password : </label> 
            <input type="password" id="password" placeholder="Enter Password" name="password" required>
            
            <button type="submit" class="btn1">Sign Up</button>
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
                    $name = $_POST['username'];
                    $email = $_POST['email'];
                    $ph = $_POST['phoneno'];
                    $pass = $_POST['password'];
                    echo $name,$email,$ph,$pass;
                    $query1 = "INSERT INTO users (name,phone_no) VALUES ('{$name}','{$ph}')";
                    $result1 = mysqli_query($con,$query1) or die('q1 not working');
                    $query2 = "INSERT INTO login (email,password,user_id) VALUES ('{$email}','{$pass}',(select uid from users where phone_no='{$ph}'))";
                    $result2 = mysqli_query($con,$query2) or die('q2 not working');
                    
                    
                    
                    echo $result3;
                    if($result1 and $result2)
                    {
                        $query3="SELECT uid from users where phone_no='{$ph}'";
                        $r1=mysqli_query($con,$query3) or die("bad query!");
                        $uid=mysqli_fetch_array($r1);
                        echo($uid['user_id']);
                        $_SESSION['uid']=$uid['user_id'];
                        echo "New user created";
                        header('Location: home.php');
                    }
                    else
                    {
                        echo 'Invalid Details!!';
                    }
                    
                    
                }
            ?>
            <br>
            <button type="button" onclick="loadsignup()" class="btn2">Login</button>

        </div> 
    </form>
</body>
</html>