<?php include('config.php');

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //calling Stored procedure select_login
    $query = "CALL select_login('$email','$password')";
    $results = mysqli_query($db_connect, $query);
    $count = mysqli_num_rows($results);
    //checking user count=1
    if ($count == 1) {
        $user_data = mysqli_fetch_array($results);
        //saving uid to into  $_SESSION variable.
        $_SESSION['uid'] = $user_data['user_id'];
        header('Location: index.php');
    } else {

        $error='Invalid Details!!';
    }
}
else {
    //checking whether $_SESSION['uid'] has a value. 
    if (isset($_SESSION['uid'])) {
        //if a value is present redirecting to home page
        header("location:index.php");
        die();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login :: Hospital Resource Mangement</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .my_form {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center mt-3"><img src="/logo.png"/></div>
        <div class="row justify-content-center mt-2">
            <form class="col-md-4 bg-light bg-gradient text-center shadow p-3 mb-5 rounded-3" method="POST" action="" >
                <h2 class="mt-3 mb-2" >Login</h2>
                <?php if(isset($error)){?>
                    <span class="text-danger"><?php echo $error;?></span>
                    <?php } ?>
                <div class="mb-2 mt-1">
                    <input class="form-control" type="email" name="email" required placeholder="Email" />
                </div>
                <div class="mb-2">
                    <input class="form-control" type="password" name="password" required placeholder="Password" />
                </div>
                <div class="d-grid mb-2">
                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                </div>
                <div class="d-grid mb-2">
                    <a class="btn btn-danger btn-block" href="/signup.php">Sign Up</a>
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