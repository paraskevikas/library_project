<?php
session_start();



?>

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
<header>

</header>

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
                <p> Complete the following form</p>
            </label>

            <input type="text" , placeholder="Enter username" , name="username">

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

            <button class="button button3" type="submit" name="submit_creds">Search</button>


        </form>

        <br /><br /><br />


        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php
                            include 'connection.php';
                            $conn = OpenCon();


                            $user_data['school_id'] = $_SESSION['school_id'];
                            $school_id = $user_data['school_id'];

                            if (isset($_POST['submit_creds'])) {

                                $username = $_POST['username'];
                                $category = $_POST['category'];

                                if (empty($_POST['category']) && empty($_POST['username'])) {

                                 //   echo '<p>Please Enter Username and/or Select Category</p>';

                                    $query2 =  "SELECT AVG(likert_id), m.username, first_name, last_name, c.category_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        INNER JOIN categories c ON r.ISBN = c.ISBN
                        WHERE m.school_id = '$school_id' 
                        GROUP BY m.card_id, c.category_name
                        ORDER BY last_name, first_name";

                                $result2 = mysqli_query($conn, $query2);

                                if (mysqli_num_rows($result2) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Average rating</th>';
                                    echo '<th>username</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '<th>Category</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result2)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                
                            }
/*
                                    $query =  "SELECT AVG(r.likert_id), m.username, m.first_name, m.last_name
                                    FROM reviews r
                                    INNER JOIN members m ON m.card_id = r.card_id
                                    WHERE m.school_id = '$school_id' 
                                    GROUP BY m.card_id
                                    ORDER BY last_name, first_name";

                                    $result = mysqli_query($conn, $query);


                                    if (mysqli_num_rows($result) == 0) {
                                        echo '<h1 style="margin-top: 5rem;">No ratings books found!</h1>';
                                    } else {

                                        echo '<div class="table-responsive">';
                                        echo '<table class="table">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>Total average rating</th>';
                                        echo '<th>username</th>';
                                        echo '<th>User First Name</th>';
                                        echo '<th>User Last Name</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_row($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    }
*/
                                } else if (empty($_POST['category']) && !empty($_POST['username'])) {

                                $query =  "SELECT AVG(likert_id), m.username, first_name, last_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        WHERE m.school_id = '$school_id' AND m.username = '$username'
                        GROUP BY m.card_id
                        ORDER BY last_name, first_name";
                                $result = mysqli_query($conn, $query);


                                if (mysqli_num_rows($result) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Total average rating</th>';
                                    echo '<th>username</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
/*
                                echo '</br>';
                                echo '</br>';

                                $query2 =  "SELECT AVG(likert_id), m.username, first_name, last_name, c.category_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        INNER JOIN categories c ON r.ISBN = c.ISBN
                        WHERE m.school_id = '$school_id' AND m.username = '$username'
                        GROUP BY m.card_id, c.category_name
                        ORDER BY last_name, first_name";

                                $result2 = mysqli_query($conn, $query2);

                                if (mysqli_num_rows($result2) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No ratings books found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Average rating</th>';
                                    echo '<th>username</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '<th>Category</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result2)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                
                            } */
                        } 
                        
                        
                        else if (!empty($_POST['category']) && empty($_POST['username'])) {

                               /* $query2 =  "SELECT AVG(likert_id), m.username, first_name, last_name, c.category_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        INNER JOIN categories c ON r.ISBN = c.ISBN
                        WHERE m.school_id = '$school_id' AND c.category_name = '$category'
                        GROUP BY m.card_id, c.category_name
                        ORDER BY last_name, first_name";

                                $result2 = mysqli_query($conn, $query2);

                                if (mysqli_num_rows($result2) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No ratings books found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Average rating</th>';
                                    echo '<th>username</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '<th>Category</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result2)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                
                            }

                            echo '</br>';
                                    echo '</br>';
*/
                                    $query3 =  "SELECT  m.school_id, c.category_name, AVG(likert_id)
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        INNER JOIN categories c ON r.ISBN = c.ISBN
                        WHERE m.school_id = '$school_id' AND c.category_name='$category'
                        GROUP BY  c.category_name
                        ORDER BY  c.category_name";

                                    $result3 = mysqli_query($conn, $query3);

                                    if (mysqli_num_rows($result3) == 0) {
                                        echo '<h1 style="margin-top: 5rem;">No result found!</h1>';
                                    } else {

                                        echo '<div class="table-responsive">';
                                        echo '<table class="table">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>School ID</th>';
                                        echo '<th>Category</th>';
                                        echo '<th>Average rating</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_row($result3)) {
                                            echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    }

                         } else {
/*
                                $query =  "SELECT AVG(likert_id), m.username, first_name, last_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        WHERE m.school_id = '$school_id' AND m.username = '$username'
                        GROUP BY m.card_id
                        ORDER BY last_name, first_name";
                                $result = mysqli_query($conn, $query);


                                if (mysqli_num_rows($result) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No ratings books found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Total average rating</th>';
                                    echo '<th>card_id</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }

                                echo '</br>';
                                echo '</br>';
*/
                                $query2 =  "SELECT AVG(likert_id), m.username, first_name, last_name, c.category_name
                        FROM reviews r
                        INNER JOIN members m ON r.card_id = m.card_id
                        INNER JOIN categories c ON r.ISBN = c.ISBN
                        WHERE m.school_id = '$school_id' AND r.active = 1 AND m.username = '$username' AND c.category_name = '$category'
                        GROUP BY m.card_id, c.category_name
                        ORDER BY last_name, first_name";

                                $result2 = mysqli_query($conn, $query2);

                                if (mysqli_num_rows($result2) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Average rating</th>';
                                    echo '<th>username</th>';
                                    echo '<th>User First Name</th>';
                                    echo '<th>User Last Name</th>';
                                    echo '<th>Category</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result2)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
                            }
                        }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>