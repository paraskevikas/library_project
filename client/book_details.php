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

    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 30%;
        }
    </style>

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
        <?php
        session_start();

        include("connection.php");
        $conn = OpenCon();

        $school_id = $_SESSION['school_id'];
        $ISBN = $_GET['ISBN'];

        $query = "SELECT title, lang, page_number, publisher, available_copies, total_copies, image_cover
                    FROM books B
                    INNER JOIN copies c ON b.ISBN = c.ISBN
                    WHERE b.ISBN = '$ISBN' AND c.school_id = '$school_id'";
        $result = mysqli_query($conn, $query);


        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">An error occured</h1>';
        } else {

            $row = mysqli_fetch_row($result);

            echo '<img src="' . $row[6] . '" alt="book_cover" class="center">';
            echo '<br/><br/><br/>';

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
            echo '<th>Language</th>';
            echo '<th>Number of pages</th>';
            echo '<th>Publisher</th>';
            echo '<th>Available Copies</th>';
            echo '<th>Total Copies</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            echo '<tr>';
            echo '<td>' . $ISBN . '</td>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td>' . $row[3] . '</td>';
            echo '<td>' . $row[4] . '</td>';
            echo '<td>' . $row[5] . '</td>';
            echo '</tr>';

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

        <br /><br /><br /><br />


        <div class='text'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Authors</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
            <br />
        </div>

        <?php

        $query = "SELECT first_name, last_name from authors WHERE ISBN = '$ISBN'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">An error occured</h1>';
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
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_row($result)) {
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[1] . '</td>';
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

        <br /><br /><br /><br />

        <div class='text'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Summary</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <?php

        $query = "SELECT descr from summary WHERE ISBN = '$ISBN'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">An error occured</h1>';
        } else {
            $row = mysqli_fetch_row($result);
            echo '<p>' . $row[0] . '</p>';
        }
        ?>

        <br /><br /><br /><br />

        <div class='text'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Categories</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <?php

        $query = "SELECT category_name from categories WHERE ISBN = '$ISBN'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">An error occured</h1>';
        } else {
            while ($row = mysqli_fetch_row($result)) {
                echo '<p>' . $row[0] . '</p>';
            }
        }
        ?>

        <br /><br /><br /><br />

        <div class='text'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Keywords</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <?php

        $query = "SELECT descr from keywords WHERE ISBN = '$ISBN'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<h1 style="margin-top: 5rem;">An error occured</h1>';
        } else {
            while ($row = mysqli_fetch_row($result)) {
                echo '<p>' . $row[0] . '</p>';
            }
        }
        ?>

        <br /><br /><br /><br />

        <div class='text'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Reviews</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
            <br />
        </div>

        <?php

        $query = "SELECT m.username, r.review_text, r.likert_id
                    FROM reviews r
                    INNER JOIN members m ON r.card_id = m.card_id
                    WHERE r.ISBN = '$ISBN' AND r.active = 1";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<p>There are no reviews for this book!</p>';
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
            echo '<th>Review</th>';
            echo '<th>Likert Points</th>';
            echo '<th>Submitted by</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_row($result)) {
                echo '<tr>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '<td>' . $row[0] . '</td>';
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


        <br /><br /><br /><br /><br /><br />


    </div>
</body>

</html>