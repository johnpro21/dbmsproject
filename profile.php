<?php include('session.php');
require('config.php');
$uid = $_SESSION['uid'];
//echo $uid;
$userdata_query = "SELECT * from users where uid='{$uid}'";
$userdata_result = mysqli_query($db_connect, $userdata_query);
$user_data = mysqli_fetch_assoc($userdata_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile :: Hospital Resource Mangement</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" style="font-size: 90%;" href="/index.php">Hospital Resource Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> -->
                </ul>
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link disabled"><?php echo $user_data['name']; ?></a>
                    </li>
                </div>
                <div>
                    <a class="btn btn-danger ms-3 me-3" href="/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="row justify-content-center">

        <form class="col-md-4 bg-light bg-gradient text-center shadow p-3 mb-5 rounded-3 " method="POST">
            <?php
            $userdata_query = "CALL SelectUserData('$uid');";
            $userdata_result = mysqli_query($db_connect, $userdata_query);
            $user_data = mysqli_fetch_assoc($userdata_result);
            $status=$_SESSION['status'];
            //print_r($user_data);
            ?>
            <h2 class="mt-3 mb-2">Profile</h2>
            <?php if (isset($status)) { ?>
                <span class="text-success"><?php echo $status;
                unset($_SESSION['status']); ?></span>
            <?php } ?><br>
            <img src="/profile_icon.png" class="img-fluid mt-3" style="height: 200px; width:auto;">
            <div class="mb-2 mt-1">
                <input class="form-control mt-5" type="text" name="name" value="<?php echo $user_data['name']; ?>" placeholder="Name" />
            </div>
            <div class="mb-2">
                <input class="form-control" type="email" name="email" value="<?php echo $user_data['email']; ?>" disabled />
            </div>
            <div class="mb-2">
                <input class="form-control" type="tel" name="phoneno" required placeholder="Phone Number" value="<?php echo $user_data['phone_no']; ?>" pattern="[0-9]{10}" maxlength="10" title="Enter Your 10 digit Moblie Number" />
            </div>
            <div class="mb-2">
                <input class="form-control" type="password" name="password" required value="<?php echo $user_data['password']; ?>" placeholder="Password" />
            </div>
            <div class="d-grid mb-2">
                <button class="btn btn-primary btn-block" type="submit" formaction="/updateAcc.php" value="update">Update Profile</button>
            </div>
        </form>
    </main>
    <div class="mt-5 text-center">
        <img src="./logo.png" class="img-fluid" />
        <p style="font-size: 7.5pt;">&copy;2021 GECSKP (IT) B1G2</p>
    </div>

    <!-- <script src="/js/bootstrap.min.js"></script> -->
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>