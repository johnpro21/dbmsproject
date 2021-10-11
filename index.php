<?php include('session.php');
require('config.php');
$uid = $_SESSION['uid'];
//echo $uid;
$userdata_query = "SELECT * from users where uid='{$uid}'";
$userdata_result = mysqli_query($db_connect, $userdata_query);
$user_data = mysqli_fetch_assoc($userdata_result);
$_SESSION['status']="";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Resource Mangement</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style the tab */
        .tab {
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            background-color: inherit;
            color: black;
            padding: 22px 16px;
            width: 100%;
            border: none;
            outline: none;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;

        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            border: 1px solid #ccc;
            border-left: none;
        }

        @media screen and (max-width: 480px) {
            .tab button {
                padding: 10px 5px;
                text-align: center;
                font-size: 17px;

            }
        }
    </style>
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
                   
                </ul>
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href='/profile.php'><?php echo $user_data['name']; ?></a>
                    </li>
                </div>
                <div>
                    <a class="btn btn-danger ms-3 me-3" href="/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="bg-light rounded">
            <div class="row pb-3 justify-content-center">
                <div class="col-md-6">
                    <form class="form-inline">
                        <select name="h_name" class="form-select" onchange="this.form.submit()">

                            <?php if (isset($_GET['h_name'])) { ?>
                                <option value="<?php echo $_GET['h_name']; ?>">(<?php echo $_GET['h_name']; ?>) Change Hospital</option>
                                <option value="" disabled></option>
                            <?php
                            } else {
                            ?>
                                <option value="" selected>Choose Hospital</option>
                            <?php
                            }
                            $q2 = "SELECT * from hos_name";
                            $res2 = mysqli_query($db_connect, $q2);

                            while ($h_name = mysqli_fetch_array($res2)) {
                            ?>
                                <option value="<?php echo $h_name['hos_name']; ?>"><?php echo $h_name['hos_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </form>
                </div>

            </div>

            <?php if (isset($_GET['h_name'])) { ?>
                <div class="row">
                    <div class="col-md-2 tab" style="padding-right: 0px; padding-left: 0px;">
                        <button class="tablinks" onclick="changeTab(event, 'requirment_near')" <?php if (isset($_GET['tab'])) {
                                                                                                    if ($_GET['tab'] != 1) {
                                                                                                        echo 'id="defaultOpen"';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo 'id="defaultOpen"';
                                                                                                } ?>>Requirements Near</button>
                        <button class="tablinks" onclick="changeTab(event, 'my_requirment')" <?php if (isset($_GET['tab'])) {
                                                                                                    if ($_GET['tab'] == 1) {
                                                                                                        echo 'id="defaultOpen"';
                                                                                                    }
                                                                                                } ?>>My Requirements</button>
                    </div>

                    <div id="my_requirment" class="col-md-10 tabcontent bg-light pt-3">

                        <table class="table">
                            <?php
                            $selected_hname = $_GET['h_name'];
                            $selected_uid = $_SESSION['uid'];
                            $my_query = "SELECT * FROM resource_rqst WHERE reqster_h_name='$selected_hname' AND reqster_uid='$selected_uid';";
                            $result_my = mysqli_query($db_connect, $my_query);
                            ?>
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Resource Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data_my = mysqli_fetch_array($result_my)) { ?>
                                    <tr>

                                        <td><?php echo $data_my['resource_type']; ?></td>
                                        <td><?php echo $data_my['description']; ?></td>
                                        <td><?php echo $data_my['quantity']; ?></td>
                                        <td><button class="btn btn-danger btn-sm" onclick="deleteResource('<?php echo $data_my['resourse_id']; ?>')">Delete</button> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <button class="btn btn-success" onclick="changeTab(event, 'new_requirment')">Add New</button>
                        <hr />
                        <script>
                            deleteResource = function(id) {
                                if (confirm('Do You Want to Delete?')) {
                                    window.location.href = encodeURI('/delReq.php?id=' + id + '&h_name=<?php echo $_GET['h_name']; ?>');
                                }
                            }
                        </script>
                    </div>

                    <div id="requirment_near" class="col-md-10 tabcontent bg-light pt-3">
                        <?php
                        $selected_hname = $_GET['h_name'];
                        $near_query = "SELECT * FROM resource_rqst WHERE reqster_h_name='$selected_hname';";
                        $result_near = mysqli_query($db_connect, $near_query); ?>
                        <div class="row">
                            <?php while ($data_near = mysqli_fetch_array($result_near)) { ?>
                                <div class="col-md-4">
                                    <div class="card border-success mb-3">
                                        <div class="card-header bg-transparent border-success"><?php echo $data_near['resource_type']; ?></div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title"><?php echo $data_near['description']; ?> - <?php echo $data_near['quantity']; ?></h5>
                                            <p class="card-text"><?php echo $data_near['reqster_name']; ?><br><?php echo $data_near['reqster_phno']; ?></p>
                                        </div>
                                        <a class="btn btn-success border-success" href="tel:'<?php echo $data_near['reqster_phno']; ?>'">Call Now</a>
                                    </div>
                                </div>
                            <?php
                            }
                            if (mysqli_num_rows($result_near) == 0) {
                                echo "<h3 class='text-center mt-3'>No Records Found</h3>";
                            }
                            ?>
                        </div>

                    </div>
                    <div id="new_requirment" class="col-md-10 tabcontent bg-light" style=" padding-right: 0px;padding-left: 0px;">
                        <form class="m-3" method="POST" id="add_new" action="/add_new.php">
                            <select name="resource_type" class="form-select">
                                <option value="">Select Requirement Type</option>
                                <option value="Tifin">Tifin</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Oxygen">Oxygen</option>
                                <option value="Ambulance">Ambulance</option>
                                <option value="Blood">Blood</option>
                            </select>
                            <div class="mb-2 mt-1">
                                <input class="form-control" type="text" name="description" required placeholder="Description" />
                            </div>
                            <div class="mb-2 mt-1">
                                <input class="form-control" type="number" name="quantity" required placeholder="Quantity" />
                            </div>
                            <input type="text" name="reqster_name" value="<?php echo $user_data['name']; ?>" hidden />
                            <input type="text" name="reqster_phno" value="<?php echo $user_data['phone_no']; ?>" hidden />
                            <input type="text" name="reqster_uid" value="<?php echo $user_data['uid']; ?>" hidden />
                            <input type="text" name="reqster_h_name" value="<?php echo $selected_hname; ?>" hidden />
                            <button class="btn btn-success btn-block" type="submit">Add Requirment</button>
                        </form>
                    </div>

                </div>



            <?php } ?>
            <script>
                function changeTab(evt, tabName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    if (tabName != "new_requirment") {
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                        }
                    }
                    document.getElementById(tabName).style.display = "block";

                    evt.currentTarget.className += " active";
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
            </script>
        </div>

    </main>
    <div class="mt-5 text-center">
        <img src="./logo.png" class="img-fluid" />
        <p style="font-size: 7.5pt;">&copy;2021 GECSKP (IT) B1G2</p>
    </div>
    <!-- <script src="/js/bootstrap.min.js"></script> -->
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>