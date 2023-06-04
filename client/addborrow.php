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
                <p> Card ID </p>
            </label>
            <input type="text" , placeholder="Enter Card ID" , name="card_id">

            <label class="form-label">
                <p> ISBN </p>
            </label>
            <input type="text" , placeholder="Enter ISBN" , name="ISBN">

            <label class="form-label">
                <p> Borrow Date (Αν το πεδίο αυτό αφεθεί κενό, θα εισαχθεί η σημερινή ημερομηνία)</p>
            </label>
            <input type="text" , placeholder="Enter Date of Borrow" , name="b_date">

            <p> Status </p>
            </label>
            </label>
            <select id="returned" name="returned">
                <option value="">Status</option>
                <option value="1">Returned</option>
                <option value="0">Not Returned</option>
            </select>


            <br />
            <br />

            <button class="button button3" type="submit" name="submit_creds">Submit</button>
            <!--<button class="button button3" formaction="home.php">Back</button>-->

        </form>

        <div class="container1">
            <?php
            include 'connection.php';
            $conn = OpenCon();
            if (isset($_POST['submit_creds'])) {
                $card_id = $_POST['card_id'];
                $ISBN = $_POST['ISBN'];
                $b_date = $_POST['b_date'];
                $returned = $_POST['returned'];
                try {
                    if (!empty($b_date)) {
                        $query = "INSERT INTO borrows (card_id, ISBN, b_date, returned)
                                VALUES ('$card_id', '$ISBN', '$b_date', '$returned')";
                        if (mysqli_query($conn, $query)) {
                            echo "New record created successfully";
                            header("Location: ./admin.php");
                            exit();
                        } else {
                            echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    } else {
                        $query = "INSERT INTO borrows (card_id, ISBN, returned)
                                VALUES ('$card_id', '$ISBN', '$returned')";
                        if (mysqli_query($conn, $query)) {
                            echo "New record created successfully";
                            header("Location: ./admin.php");
                            exit();
                        } else {
                            echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }
                } catch (exception $e) {
                    echo '<p>' . $e->getMessage() . '</p>';
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