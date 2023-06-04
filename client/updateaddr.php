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
                <p> Stree Name </p>
            </label>
            <input type="text" , placeholder="Street Name" , name="street_name">

            <label class="form-label">
                <p> Street Number </p>
            </label>
            <input type="text" , placeholder="Street Number" , name="street_number">

            <label class="form-label">
                <p> Postal Code </p>
            </label>
            <input type="text" , placeholder="Postal Code" , name="postal_code">

            <label class="form-label">
                <p> City </p>
            </label>
            <input type="text" , placeholder="City" , name="city">
            <br /><br />

            <button class="button button3" type="submit" name="submit_creds">Submit</button>

        </form>
        <div class="container1">
            <?php

            include 'connection.php';
            $conn = OpenCon();


            $school_id = $_GET['school_id'];

            if (isset($_POST['submit_creds'])) {
                $street_name = $_POST['street_name'];
                $street_number = $_POST['street_number'];
                $postal_code = $_POST['postal_code'];
                $city = $_POST['city'];
                echo '<br />';

                if (!empty($street_name) && !empty($postal_code) && !empty($city) && !empty($street_number)) {

                    try {
                        $query = "UPDATE addresses
                                    SET street_name = '$street_name', street_number = '$street_name', city = '$city', postal_code = '$postal_code'
                                    WHERE school_id = '$school_id'";

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