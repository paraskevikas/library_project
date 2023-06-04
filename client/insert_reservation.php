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

            $card_id = $_SESSION['card_id'];
            $ISBN = $_GET['ISBN'];

            try {
                $query = "UPDATE reservations
                SET stat = 'cancelled'
                WHERE (CURRENT_DATE > DATE_ADD(creation_date, INTERVAL 7 DAY) AND stat <> 'cancelled');";

                mysqli_query($conn, $query);

            } catch (exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }

            try {
                $query = "INSERT INTO reservations (ISBN, card_id)
                VALUES ('$ISBN', '$card_id')";

                if (mysqli_query($conn, $query)) {
                    echo "New record created successfully";
                    header("Location: user_reservations.php?card_id=' . $card_id . '");
                } else {
                    echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                }
            } catch (exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
            ?>
            
            <br /><br /><br /><br /><br /><br /><br />
            <a href="user1.php" class="button button3">Go back</a>

        </div>
    </div>

</body>

</html>