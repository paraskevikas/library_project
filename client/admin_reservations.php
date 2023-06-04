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


    <div class="container">

            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php



                            $user_data['school_id'] = $_SESSION['school_id'];
                            $school_id = $user_data['school_id'];

                            echo '<br/>';
                            echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Reservations of Books from School with School ID:' . $school_id . '</br></span>';
                            echo '<br/>';

                            $query6 = "SELECT ISBN, r.card_id, m.username, creation_date, stat FROM reservations r, members m
                                                             where m.school_id=$school_id and r.card_id=m.card_id
                                                             ORDER BY creation_date";
                            $result6 = mysqli_query($conn, $query6);

                            if (mysqli_num_rows($result6) == 0) {
                                echo '<h1 style="margin-top: 5rem;">No result!</h1>';
                            } else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>ISBN</th>';
                                echo '<th>Card ID</th>';
                                echo '<th>username</th>';
                                echo '<th>Creation Date</th>';
                                echo '<th>Status</th>';
                                echo '<th></th>';
                                echo '<th></th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = mysqli_fetch_row($result6)) {
                                    echo '<tr>';
                                    echo '<td>' . $row[0] . '</td>';
                                    echo '<td>' . $row[1] . '</td>';
                                    echo '<td>' . $row[2] . '</td>';
                                    echo '<td>' . $row[3] . '</td>';
                                    echo '<td>' . $row[4] . '</td>';
                                    echo '<td>';

                                    echo '<td><a type="button" class="button button3" href="./updatereservations_admin.php?ISBN=' . $row[0] . '&card_id=' . $row[1] . '">';

                                    echo '<i class="fa fa-edit"></i>';
                                    echo '</td>';
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