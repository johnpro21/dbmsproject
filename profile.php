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

    <main class="container">

    </main>
    <div class="mt-5 text-center">
            <img src="./logo.png" class="img-fluid" />
            <p style="font-size: 7.5pt;">&copy;2021 GECSKP (IT) B1G2</p>
        </div>

    <!-- <script src="/js/bootstrap.min.js"></script> -->
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>