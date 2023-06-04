<?php
session_start();



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

        <br />

        <div class="text" style="text-align: center;">
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Τα βιβλία που έχω δανειστεί</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br /><br /><br />


        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php
                            include 'connection.php';
                            $conn = OpenCon();

                            $username = $_SESSION['username'];


                            $query =  "SELECT username, b.ISBN, title, b_date, r_date, returned
                                    FROM books b
                                    INNER JOIN borrows c ON b.ISBN = c.ISBN
                                    INNER JOIN members m ON m.card_id = c.card_id
                                    WHERE m.username = '$username'";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0) {
                                echo '<h1 style="margin-top: 5rem;">No books found!</h1>';
                            } else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Username</th>';
                                echo '<th>ISBN</th>';
                                echo '<th>Books</th>';
                                echo '<th>Borrowed on</th>';
                                echo '<th>Should be returned on</th>';
                                echo '<th>Has been returned?</th>';
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
                                    if ($row[5] == 0)
                                        echo '<td>no</td>';
                                    else echo '<td>yes</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            }

                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>