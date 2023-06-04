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
        <div class="text" style="text-align: center;">
            <br /><br /><br /><br /><br /><br /><br />
            <?php
            session_start();

            include "connection.php";
            $conn = OpenCon();

            $old = $_GET['old'];
            $ISBN = $_GET['ISBN'];

            try {
                $query = "DELETE FROM keywords
                WHERE ISBN = '$ISBN' AND descr = '$old'";

                if (mysqli_query($conn, $query)) {
                    echo "<hr>Record deleted successfully";
                    exit();
                } else {
                    echo "<hr>Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                }
            } catch (exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }

            ?>

            <br /><br /><br /><br /><br /><br /><br />

        </div>
    </div>

</body>

</html>