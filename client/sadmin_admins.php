<?php
session_start();

include("connection.php");
$conn = OpenCon();
?>

<!DOCTYPE html>
<html>

<head>
    <title lang='gr'>Βιβλιοθήκη ΕΜΠ - Βάση Δεδομένων</title>
    <link rel='icon' href='prometheus.png' type='image/png' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </meta>
    <meta name='author' content='Κωνσταντίνα Παπία, Παρασκευή Κασιούμη'>
    </meta>
    <meta charset="UTF-8">
    </meta>
    <link rel='stylesheet' href='common.css'>
    </link>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>


<body>



    <div class="navbar">
        <a class="navbar-brand" href="home.php">
            <div class="logo-image">
                <img src="prometheus.png" class="img-fluid" alt="Βιβλιοθήκη ΕΜΠ" style="width:35px;height:35px;">
            </div>
        </a>



        <a href="home.php">Αρχική Σελίδα</a>
        <a href="about.html">Σχετικά Με</a>

    </div>

    <br />
    <br />



    <div class="main-content2">

        <div class='text' style='text-align: center;'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Administrators</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br /><br />

        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php

                            $query = "SELECT a.admin_id, a.first_name, a.last_name, a.username, a.passcode, a.school_id, s.school_name
                            FROM administrators a
                            INNER JOIN schools s ON a.school_id = s.school_id
                            ORDER BY a.school_id";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0)
                                echo '<h1 style="margin-top: 5rem;">No administrators found!</h1>';
                            else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Admin ID</th>';
                                echo '<th>First Name</th>';
                                echo '<th>Last Name</th>';
                                echo '<th>username</th>';
                                echo '<th>password</th>';
                                echo '<th>School ID</th>';
                                echo '<th>School Name</th>';
                                echo '<th>Update</th>';
                                echo '<th>Delete</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = mysqli_fetch_row($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row[0] . '</td>';
                                    echo '<td>' . $row[1] . '</td>';
                                    echo '<td>' . $row[2] . '</td>';
                                    echo '<td>' . $row[3] . '</td>';
                                    echo '<td>' . $row[4] . '</td>';                                    
                                    echo '<td>' . $row[5] . '</td>';
                                    echo '<td>' . $row[6] . '</td>';
                                    echo '<td>';
                                    echo '<a type="button" class="button" href="./updateadmin.php?admin_id=' . $row[0] . '">';
                                    echo '<i class="fa fa-edit"></i>';
                                    echo '</a>';
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<a type="button" class="button" href="./deleteadmin.php?admin_id=' . $row[0] . '">';
                                    echo '<i class="fa fa-trash"></i>';
                                    echo '</a>';
                                    echo '</td>';

                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br /><br /><br /><br /><br />

        <div class='text' style='text-align: center;'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Applications for an administrator's position</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br /><br />

        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php

                            $query = "SELECT a.request_id, a.first_name, a.last_name, a.school_id, s.school_name, a.stat
                            FROM admin_applicant a
                            INNER JOIN schools s ON a.school_id = s.school_id
                            ORDER BY request_id";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0)
                                echo '<h1 style="margin-top: 5rem;">No applications found!</h1>';
                            else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Request ID</th>';
                                echo '<th>First Name</th>';
                                echo '<th>Last Name</th>';
                                echo '<th>School ID</th>';
                                echo '<th>School Name</th>';
                                echo '<th>Status</th>';
                                echo '<th>Update Status</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = mysqli_fetch_row($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row[0] . '</td>';
                                    echo '<td>' . $row[1] . '</td>';
                                    echo '<td>' . $row[2] . '</td>';
                                    echo '<td>' . $row[3] . '</td>';
                                    echo '<td>' . $row[4] . '</td>';
                                    echo '<td>' . $row[5] . '</td>';
                                    echo '<td>';
                                    echo '<a type="button" class="button" href="./updateadminapplic.php?request_id=' . $row[0] . '">';
                                    echo '<i class="fa fa-edit"></i>';
                                    echo '</a>';
                                    echo '</td>';

                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

       

                        </div>


</body>

</html>