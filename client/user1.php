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

        <div type="text" style="text-align: center;">
            <a href="student.php" class="button button3">Back</a>
        </div>

        <form class="form-horizontal" name="form" method="POST">
            <label class="form-label">
                <p> Complete the following form </p>
            </label>

            <input type="text" , placeholder="Enter Title" , name="title">

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

            <input type="text" , placeholder="Enter Authors First Name" , name="first_name">
            <input type="text" , placeholder="Enter Authors Last Name" , name="last_name">

            <br />
            <br />

            <button class="button button3" type="submit" name="submit_creds">Search</button>
        </form>

        <br />
        <br />

        <div class="container">
            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php
                            include 'connection.php';
                            $conn = OpenCon();

                            $user_data['school_id'] = $_SESSION['school_id'];
                            $user_data['card_id'] = $_SESSION['card_id'];
                            $card_id = $user_data['card_id'];
                            $school_id = $user_data['school_id'];


                            // select book
                            if (isset($_POST['submit_creds'])) {
                                $title = $_POST['title'];
                                $category = $_POST['category'];
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];

                                if (empty($_POST['category'])) {
                                    $query =  "SELECT e.school_name, a.ISBN, title, category_name, first_name, last_name
                                    FROM books as a, authors as b, categories as c, copies d, schools e
                                    WHERE a.ISBN=b.ISBN AND a.ISBN=c.ISBN AND a.ISBN = d.ISBN AND d.school_id=e.school_id AND (title like '%$title%' and first_name like '%$first_name%' and last_name like '%$last_name%') and e.school_id='$school_id'
                                    ORDER BY title, last_name, first_name";
                                } else {
                                    $query =  "SELECT e.school_name, a.ISBN, title, category_name, first_name, last_name
                                    FROM books as a, authors as b, categories as c, copies d, schools e
                                    WHERE a.ISBN=b.ISBN AND a.ISBN=c.ISBN AND a.ISBN = d.ISBN AND d.school_id=e.school_id AND c.category_name = '$category' AND (title like '%$title%' and first_name like '%$first_name%' and last_name like '%$last_name%') and e.school_id='$school_id'
                                    ORDER BY title, last_name, first_name";
                                }
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No books found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';

                                    echo '<th>School</th>';
                                    echo '<th>ISBN</th>';
                                    echo '<th>Title</th>';
                                    echo '<th>Category</th>';
                                    echo '<th>Author First Name</th>';
                                    echo '<th>Author Last Name</th>';
                                    echo '<th>Make a Review</th>';
                                    echo '<th>Book details</th>';
                                    echo '<th>Make a Reservation </th>';

                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '<td>' . $row[5] . '</td>';

                                        echo '<td><a type="button" class="button button3" href="./review.php?ISBN=' . $row[1] . '">Review</td>';
                                        echo '<td><a type="button" class="button button3" href="./book_details.php?ISBN=' . $row[1] . '"">details</td>';
                                        echo '<td><a type="button" class="button button3" href="./insert_reservation.php?ISBN=' . $row[1] . '"">Reserve</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
                            }



                            ?>
                        </div>
                    </div>
                </div>

            </div>
</body>

</html>