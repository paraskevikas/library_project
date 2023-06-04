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



        <form class="form-horizontal" name="student-form" method="POST">



            <?php

            include 'connection.php';
            $conn = OpenCon();
            $ISBN = $_GET['ISBN'];

            session_start();
            $school_id = $_SESSION['school_id'];
            
            $query = "SELECT title, ISBN FROM books WHERE ISBN = $ISBN";
            $res1 = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($res1);

            echo '<div class="form-group col-sm-3 mb-3">';
            echo '<label class = "form-label"> <p>Are you sure you want to delete book: <br><b>' . $row[0] . ' ' . $row[1] . ' from your library?</b></p></label>';

            echo '<hr></div>';



            ?>



            <div class="form-group col-sm-3 mb-3">
                <?php


                if (isset($_POST['submit_del'])) {

                    $query = "DELETE FROM copies
                    WHERE school_id = $school_id AND ISBN = $ISBN";

                    try {
                        if (mysqli_query($conn, $query)) {
                            header("Location: ./admin.php");
                            exit();
                        } else {
                            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    } catch (exception $e) {
                        echo '<p>' . $e->getMessage() . '</p>';
                    }
                }


                ?>
            </div>

            <button class="button" class="btn btn-primary btn-submit-custom" type="submit" name="submit_del">Delete</button>
            <button class="button" class="btn btn-primary btn-submit-custom" formaction="admin.php">Back</button>
        </form>
    </div>
    </div>
    </div>



</body>

</html>