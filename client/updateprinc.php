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
            <input type="text" , placeholder="Enter principal's First Name" , name="first_name">

            <label class="form-label">
                <p> Last Name </p>
            </label>
            <input type="text" , placeholder="Enter principal's Last Name" , name="last_name">

            <br />
            <br />

            <button class="button button3" type="submit" name="submit_creds">Submit</button>

            <button class="button button3" type="submit" name="back">Back</button>

        </form>
        <div class="container1">
            <?php

            include 'connection.php';
            $conn = OpenCon();

            $principal_id = $_GET['principal_id'];

            if (isset($_POST['submit_creds'])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];

                echo '<br />';

                if (!empty($first_name) && !empty($last_name)) {

                    try {
                        $query = "UPDATE principals
                                    SET first_name = '$first_name', last_name = '$last_name'
                                    WHERE principal_id = '$principal_id'";

                        if (mysqli_query($conn, $query)) {
                            echo "<hr>Record updated successfully";
                            header("Location: sadmin.php");
                        } else {
                            echo "<hr>Error while updating record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    } catch (exception $e) {
                        echo '<p>' . $e->getMessage() . '</p>';
                    }
                } else {
                    echo '<hr>No valid information';
                }
            }

            if (isset($_POST['back']))
                header("Location: sadmin.php");
    


            ?>
        </div>
    </div>
    </div>
    </div>

    </div>
</body>

</html>