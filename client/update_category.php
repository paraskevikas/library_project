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
                <p> Category Name</p>
            </label>
            <select id="category" name="category">
                <option value="">Select Category</option>
                <option value="Art">Art</option>
                <option value="Biography">Biography</option>
                <option value="Cooking">Cooking</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Fiction">Fiction</option>
                <option value="History">History</option>
                <option value="Humor">Humor</option>
                <option value="Mystery">Mystery</option>
                <option value="Non-fiction">Non-fiction</option>
                <option value="Religion">Religion</option>
                <option value="Romance">Romance</option>
                <option value="Science fiction">Science fiction</option>
                <option value="Self-help">Self-help</option>
                <option value="Travel">Travel</option>
                <option value="Young adult">Young adult</option>
            </select>


    
    <br />
    <br />

    <button class="button button3" type="submit" name="submit_creds">Submit</button>

    </form>

    <div class="container1">
        <?php

        include 'connection.php';
        $conn = OpenCon();

        $ISBN = $_GET['ISBN'];
        $old = $_GET['old'];


        if (isset($_POST['submit_creds'])) {
            $name = $_POST['category'];

            echo '<br />';

            if (!empty($name)) {
                try {

                    $query = "UPDATE categories
                            SET category_name = '$name'
                            WHERE category_name = '$old' AND ISBN = '$ISBN'";

                    if (mysqli_query($conn, $query)) {
                        echo "<hr>New record updated successfully";
                        exit();
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
    </div>
    </div>
    </div>

    </div>
</body>

</html>