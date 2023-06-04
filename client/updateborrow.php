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

            $borrow_id = $_GET['borrow_id'];

            try {
                        $query = "UPDATE borrows
                        SET returned = 1
                        WHERE borrow_id = $borrow_id";

                        if (mysqli_query($conn, $query)) {
                            echo "Record updated successfully";
                            header("Location: admin.php");
                        } else {
                            echo "Error while updating record: <br>" . mysqli_error($conn) . "<br>";
                        }
            } catch (exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
            ?>

            <br /><br /><br /><br /><br /><br /><br />
            <a href="admin.php" class="button button3">Back</a>

        </div>
    </div>

</body>

</html>