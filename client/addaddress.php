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

            <label class="form-label">
                <p> School </p>
            </label>
            <?php

            include 'connection.php';
            $conn = OpenCon();

            echo '<select id="school_id" name="school_id">';

            $query = "SELECT school_id, school_name
            FROM schools";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                echo '<h1 style="margin-top: 5rem;">An error occured!</h1>';
            } else {
                echo '<option value="0">Choose your School</option>';
                while ($row = mysqli_fetch_row($result)) {
                    echo '<option value=' . $row[0] . '>' . $row[1] . '</option>';
                }
                echo '</select>';
            }
            ?>
            <br />
            <br />

            <button class="button button3" type="submit" name="submit_creds">Submit</button>

        </form>
        <div class="container1">
            <?php

            if (isset($_POST['submit_creds'])) {
                $street_name = $_POST['street_name'];
                $street_number = $_POST['street_number'];
                $postal_code = $_POST['postal_code'];
                $city = $_POST['city'];
                $school_id = $_POST['school_id'];

                echo '<br />';

                if (!empty($school_id) && !empty($street_name) && !empty($postal_code) && !empty($city) && !empty($street_number)) {

                    try {
                        $query = "INSERT INTO addresses (street_name, street_number, postal_code, school_id, city)
                                VALUES ('$street_name', '$street_number', '$postal_code', '$school_id', '$city')";
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
                    echo '<hr>Invalid information';
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