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


        <div class='text'>
            <a href="user1.php">3.3.1 Όλα τα βιβλία που έχουν καταχωριστεί (Κριτήρια αναζήτησης: τίτλος/ κατηγορία/ συγγραφέας), δυνατότητα επιλογής βιβλίου και δημιουργία αιτήματος κράτησης.</a>
        </div>
        <div class='text'>
            <a href="user2.php">3.3.2 Λίστα όλων των βιβλίων που έχει δανειστεί ο συγκεκριμένος χρήστης.</a>
        </div>

        <br />
        <br />

        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php



                            $user_data['card_id'] = $_SESSION['card_id'];

                            //echo $user_data['username'];

                            $card_id = $user_data['card_id'];


                            $query = "SELECT * FROM members where card_id=$card_id";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0) {
                                echo '<h1 style="margin-top: 5rem;">No user found!</h1>';
                            } else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Card ID</th>';
                                echo '<th>First Name</th>';
                                echo '<th>Last name</th>';
                                echo '<th>Username</th>';
                                echo '<th>Password</th>';
                                echo '<th>Birthday</th>';
                                echo '<th>Phone</th>';
                                echo '<th>Email</th>';
                                echo '<th></th>';
                                echo '<th></th>';
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
                                    echo '<td>' . $row[7] . '</td>';
                                    echo '<td>';



                                    echo '<a type="button" class="button" href="./updatestudent.php?card_id=' . $row[0] . '">';
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

        <div type="text" style="text-align: center;">

            <br /><br /><br />

           <a href="user_reservations.php" class="button button3">Οι κρατήσεις μου</a>

           <br /><br /><br />

           <div class='text' style='text-align: center;'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Οι αξιολογήσεις μου</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php

                            $query = "SELECT b.ISBN, b.title, r.review_text, r.likert_id, r.active
                            FROM reviews r
                            INNER JOIN books b ON r.ISBN = b.ISBN
                            WHERE r.card_id = $card_id
                            ORDER BY b.title";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0)
                                echo '<h1 style="margin-top: 5rem;">No reviews found!</h1>';
                            else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>ISBN</th>';
                                echo '<th>Title</th>';
                                echo '<th>Review text</th>';
                                echo '<th>Likert Points</th>';
                                echo '<th>Status</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = mysqli_fetch_row($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row[0] . '</td>';
                                    echo '<td>' . $row[1] . '</td>';
                                    echo '<td>' . $row[2] . '</td>';
                                    echo '<td>' . $row[3] . '</td>';
                                    if ($row[4] == 0)
                                        echo '<td>inactive</td>';
                                    else echo '<td>active</td>';

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
    </div>
</body>

</html>