<?php
include('config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $ph = $_POST['phoneno'];
    $pass = $_POST['password'];
    //echo $name, $email, $ph, $pass;
    $query_email_check = "SELECT email FROM login WHERE email='$email';";
    $result_email_check = mysqli_query($db_connect, $query_email_check);
    $email_check_count = mysqli_num_rows($result_email_check);
    if ($email_check_count == 0) {
        $query1 = "INSERT INTO users (name,phone_no) VALUES ('{$name}','{$ph}');";
        $result1 = mysqli_query($db_connect, $query1);
        $result1data = mysqli_insert_id($db_connect);
        $query2="INSERT INTO login (email,password,user_id) VALUES ('{$email}','{$pass}','{$result1data}')";
        $result2 = mysqli_query($db_connect, $query2);
        if ($result1 && $result2) {
            $query3 = "SELECT uid from users where phone_no='{$ph}'";
            $r1 = mysqli_query($db_connect, $query3) or die("bad query!");
            $uid = mysqli_fetch_array($r1);
            //echo ($uid['user_id']);

            $_SESSION['uid'] = $uid['uid'];
            $_SESSION['u_email'] = $email;
            //echo "New user created";
            header('Location: index.php');
        } else {
            $error = "Error in Given data";
        }
    } else {
        $error = "Email Already Exists.";
    }
} else {
    if (isset($_SESSION['uid'])) {
        header("location:index.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="text-center mt-3"><img src="/logo.png" /></div>
        <div class="row justify-content-center mt-2">
            <form class="col-md-4 bg-light bg-gradient text-center shadow p-3 mb-5 rounded-3" method="POST" action="">
                <h2 class="mt-3 mb-2">Sign Up</h2>
                <?php if (isset($error)) { ?>
                    <span class="text-danger"><?php echo $error; ?></span>
                <?php } ?>
                <div class="mb-2 mt-1">
                    <input class="form-control" type="text" name="username" required placeholder="Name" />
                </div>
                <div class="mb-2">
                    <input class="form-control" type="email" name="email" required placeholder="Email" />
                </div>
                <div class="mb-2">
                    <input class="form-control" type="tel" name="phoneno" required placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" title="Enter Your 10 digit Moblie Number" />
                </div>
                <div class="mb-2">
                    <input class="form-control" type="password" name="password" required placeholder="Password" />
                </div>
                <div class="d-grid mb-2">
                    <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                </div>
                <div class="d-grid mb-2">
                    <a class=" btn-link" href="/login.php"> Go to Login</a>
                </div>
                <div class="d-grid mt-2">
                    <p style="font-size: 7.5pt;">&copy;2021 GECSKP (IT) B1G2</p>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>