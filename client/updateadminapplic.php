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
                <p>Update Status</p>
            </label>
            <select id="status" name="status">
                <option value="">Select New Status</option>
                <option value="approved">approved</option>
                <option value="pending">pending</option>
                <option value="rejected">rejected</option>
            </select>


    
    <br />
    <br />

    <button class="button button3" type="submit" name="submit_creds">Submit</button>

    </form>

    <div class="container1">
        <?php

        include 'connection.php';
        $conn = OpenCon();

        $request_id = $_GET['request_id'];

        if (isset($_POST['submit_creds'])) {

            $status = $_POST['status'];

            echo '<br />';

            if (!empty($status)) {
                try {

                    $query = "UPDATE admin_applicant
                            SET stat = '$status'
                            WHERE request_id = $request_id";

                    if (mysqli_query($conn, $query)) {
                        echo "<hr>New record updated successfully";
                        header('Location: sadmin.php');
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


        ?>
    </div>
</body>

</html>