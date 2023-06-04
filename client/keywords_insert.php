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

    <div class="main-content2">
        <form class="form-horizontal" name="form" method="POST">
            <label class="form-label">
                <p> Keyword </p>
            </label>
            <input type="text" , placeholder="Enter Keywords" , name="keyword">

            <br />
            <br />
            <button class="button" type="submit" name="submit_creds">Submit</button>


            <div class="text" style="text-align: center;">
                <br /><br /><br /><br /><br /><br /><br />
                <?php
                session_start();

                include "connection.php";
                $conn = OpenCon();

                $ISBN = $_GET['ISBN'];

                if (isset($_POST['submit_creds'])) {

                    $keyword = $_POST['keyword'];

                    if (!empty($keyword)) {

                        try {
                                $query2 = "INSERT INTO keywords (ISBN, descr) values ('$ISBN', '$keyword')";

                                if (mysqli_query($conn, $query2)) {
                                    echo "<hr>New record created successfully";
                                    exit();
                                } else {
                                    echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                                }
                            
                        } catch (exception $e) {
                            echo '<p>' . $e->getMessage() . '</p>';
                        }
                    } 
                     else {
                        echo '<hr>No valid information';
                     }
                }
                

                ?>

            </div>
    </div>

</body>

</html>