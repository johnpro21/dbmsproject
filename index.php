<?php include('session.php');
require('config.php') ?>
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
            min-height: 300px;
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
            min-height: 300px;
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
                            <?php
                            } else {
                            ?>
                                <option value="">Choose Hospital</option>
                            <?php
                            }
                            ?>
                            <?php
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
                        <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">My Requirements</button>
                        <button class="tablinks" onclick="openCity(event, 'Paris')">Requirements Near</button>
                    </div>

                    <div id="London" class="col-md-9 tabcontent">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button>
                    </div>

                    <div id="Paris" class="col-md-9 tabcontent">
                        <h3>Paris</h3>
                        <p>Paris is the capital of France.</p>
                    </div>

                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
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