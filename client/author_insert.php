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
        <form class="form-horizontal" name="form" method="POST">
            <label class="form-label">
                <p> First Name </p>
            </label>
            <input type="text" , placeholder="Enter Author's First Name" , name="first_name">

            <label class="form-label">
                <p> Last Name </p>
            </label>
            <input type="text" , placeholder="Enter Author's Last Name" , name="last_name">

            <label class="form-label">
                <p> Author ID *</p>
            </label>
            <input type="text" , placeholder="Enter Author's ID" , name="author_id">

            <br /><br />

            <p>* Πριν υποβάλλετε το αίτημα, ελέγξτε στον παρακάτω σύνδεσμο αν ο συγγραφέας υπάρχει ήδη καταχωρημένος στη βάση.
                Αν υπάρχει στη βάση, τότε εισάγετε το κατάλληλο author id. Αλλιώς αφήστε το πεδίο του author id κενό.
            </p>

            <div type="text" style="text-align: center;">
                <a href="admin1.php" class="button button3">Check</a>

            </div>

            <?php

            include 'connection.php';
            $conn = OpenCon();

            $ISBN = $_GET['ISBN'];


            ?>
            <br />
            <br />

            <button class="button button3" type="submit" name="submit_creds">Submit</button>

        </form>
        <div class="container1">
            <?php

            if (isset($_POST['submit_creds'])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $author_id = $_POST['author_id'];

                echo '<br />';

                if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
                    if (empty($author_id)) {
                        try {

                            $query = "INSERT INTO authors (first_name, last_name, ISBN)
                                VALUES ('$first_name', '$last_name', '$ISBN')";

                            if (mysqli_query($conn, $query)) {
                                echo "<hr>New record created successfully";
                                exit();
                            } else {
                                echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                            }
                        } catch (exception $e) {
                            echo '<p>' . $e->getMessage() . '</p>';
                        }
                    } else {
                        try {
                            $query = "INSERT INTO authors (first_name, last_name, author_id, ISBN)
                                VALUES ('$first_name', '$last_name', '$author_id','$ISBN')";

                            if (mysqli_query($conn, $query)) {
                                echo "<hr>New record created successfully";
                                exit();
                            } else {
                                echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                            }
                        } catch (exception $e) {
                            echo '<p>' . $e->getMessage() . '</p>';
                        }
                    }
                } else {
                    echo '<hr>No valid information';
                }
            }


            ?>
        </div>
    </div>
    </div>
    </div>

    </div>
</body>

</html>