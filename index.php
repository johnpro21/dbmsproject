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
    <title>Document</title>
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
            padding: 0px 12px;
            border: 1px solid #ccc;
            border-left: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hospital Resource Management</a>
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
        <div class="bg-light rounded">
            <div class="row pb-3 justify-content-center">
                <div class="col-md-6">
                    <form class="form-inline">
                        <select name="h_name" class="form-control" onchange="this.form.submit()">

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
                    <div class="col-md-3 tab">
                        <button class="tablinks" onclick="changeTab(event, 'my_requirment')" id="defaultOpen">My Requirements</button>
                        <button class="tablinks" onclick="changeTab(event, 'requirment_near')">Requirements Near</button>
                    </div>

                    <div id="my_requirment" class="col-md-9 tabcontent">
                        <button class="btn btn-success" onclick="changeTab(event, 'new_requirment')">Add New</button>
                        <table class="table">
                            <?php
                            $selected_hname = $_GET['h_name'];
                            $selected_uid = $_SESSION['uid'];
                            $my_query = "SELECT * FROM resource_rqst WHERE reqster_h_name='$selected_hname' AND reqster_uid='$selected_uid';";
                            $result_my = mysqli_query($db_connect, $my_query);
                            ?>
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                    <th scope="col">Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data_my = mysqli_fetch_array($result_my)) { ?>
                                    <tr>
                                        <th scope="row">1</th>
                                        
                                        <td><?php echo $data_my['resource_type'];?></td>
                                        <td><?php echo $data_my['description'];?></td>
                                        <td><?php echo $data_my['quantity'];?></td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>

                    <div id="requirment_near" class="col-md-9 tabcontent">
                        <?php
                        $selected_hname = $_GET['h_name'];
                        $near_query = "SELECT * FROM resource_rqst WHERE reqster_h_name='$selected_hname';";
                        $result_near = mysqli_query($db_connect, $near_query); ?>
                        <div class="row">
                            <?php while ($data_near = mysqli_fetch_array($result_near)) { ?>
                                <div class="col-md-4">
                                    <div class="card border-success mb-3">
                                        <div class="card-header bg-transparent border-success">Header</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title">Success card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                        <div class="card-footer bg-transparent border-success">Footer</div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div id="new_requirment" class="col-md-9 tabcontent">

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

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>