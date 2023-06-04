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
            <h3>Οι κρατήσεις μου</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br /><br /><br />


        <?php

        session_start();

        include("connection.php");
        $conn = OpenCon();

        $card_id = $_SESSION['card_id'];

        $query = "SELECT r.ISBN, title, creation_date, stat
                FROM reservations r
                INNER JOIN books b on r.ISBN = b.ISBN
                WHERE r.card_id = '$card_id'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">No reservations</h1>';
        } else {
            echo '<div class="container">';
            echo '<div class="row" id="row">';
            echo '<div class="col-md-12">';
            echo '<div class="card" id="card-container">';
            echo '<div class="card-body" id="card">';

            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ISBN</th>';
            echo '<th>Title</th>';
            echo '<th>Submitted on</th>';
            echo '<th>Status</th>';
            echo '<th>Cancel reservation</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_row($result)) {
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '<td>' . $row[3] . '</td>';
                echo '<td><a type="button" class="button button3" href="./update_reservation-user.php?ISBN=' . $row[0] . '"">Cancel</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        ?>

        <br /><br /><br />
        <div type="text" style="text-align: center;">
            <a href="student.php" class="button button3">Back</a>
        </div>

    </div>


</body>

</html>