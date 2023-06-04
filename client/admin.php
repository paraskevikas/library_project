<?php
session_start();


include("connection.php");
$conn = OpenCon();


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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
        <div class='text'>
            <a href="admin1.php">3.2.1 Παρουσίαση όλων των βιβλίων κατά Τίτλο, Συγγραφέα (Κριτήρια αναζήτησης: τίτλος/ κατηγορία/ συγγραφέας/ αντίτυπα).</a>
        </div>
        <div class='text'>
            <a href="admin2.php">3.2.2 Εύρεση όλων των δανειζόμενων που έχουν στην κατοχή τους τουλάχιστον ένα βιβλίο και έχουν καθυστερήσει την επιστροφή του. (Κριτήρια αναζήτησης: Όνομα, Επώνυμο, Ημέρες Καθυστέρησης).</a>
        </div>
        <div class='text'>
            <a href="admin3.php">3.2.3 Μέσος Όρος Αξιολογήσεων ανά δανειζόμενο και κατηγορία (Κριτήρια αναζήτησης: χρήστης/ κατηγορία)</a>
        </div>


        <br />
        <br />

        <div class='text'>
            <a href="admin_books.php"> - Εμφάνιση/Καταχώριση/Επεξεργασία βιβλίων σχολικής μονάδας</a>
        </div>
        <div class='text'>
            <a href="admin_members.php"> - Εμφάνιση/Επεξεργασία Χρηστών/Members, έγκριση αιτήσεων</a>
        </div>
        <div class='text'>
            <a href="admin_reviews.php"> - Εμφάνιση/Επεξεργασία Αξιολογήσεων</a>
        </div>
        <div class='text'>
            <a href="admin_reservations.php"> - Εμφάνιση/Επεξεργασία Κρατήσεων</a>
        </div>
        <div class='text'>
            <a href="admin_borrows.php"> - Εμφάνιση/Επεξεργασία Δανεισμών</a>
        </div>

        <!--           <a type="button" class="button" href="./addbook.php">
            <i class="fa fa-plus"></i>
             Add New Book
            </a>-->

        <div class="container">

            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php



                            $user_data['school_id'] = $_SESSION['school_id'];
                            $school_id = $user_data['school_id'];
/*
                            echo '<br/>';
                            echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Books and Copies of School with School ID:' . $school_id . '</br></span>';
                            echo '<br/>';

                            echo '<a type="button" class="button" href="./addbook.php" style = "position:relative; left:-538px;">';
                            echo '<i class="fa fa-plus"></i>';
                            echo 'Add New Book';
                            echo '</a>';

                            $query = "SELECT b.ISBN, b.title, b.lang, b.page_number, b.publisher, c.available_copies, c.total_copies
                            FROM books b
                            INNER JOIN copies c ON c.ISBN = b.ISBN
                            WHERE c.school_id = '$school_id'
                            ORDER BY ISBN";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0) {
                                echo '<h1 style="margin-top: 5rem;">No user found!</h1>';
                            } else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>ISBN</th>';
                                echo '<th>Title</th>';
                                echo '<th>Language</th>';
                                echo '<th>Number of Pages</th>';
                                echo '<th>Publisher</th>';
                                echo '<th>Available Copies</th>';
                                echo '<th>Total Copies</th>';
                                echo '<th>Book details</th>';
                                echo '<th></th>';
                                echo '<th></th>';
                                echo '<th></th>';
                                echo '<th></th>';
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
                                    echo '<td>' . $row[6] . '</td>';

                                    echo '<td><a type="button" class="button button3" href="./book_details_admin.php?ISBN=' . $row[0] . '"">details</td>';

                                    echo '<td>';

                                    echo '<td><a type="button" class="button" href="./updatebook.php?ISBN=' . $row[0] . '">';
                                    echo '<i class="fa fa-edit"></i>';
                                    echo '</td>';
                                    echo '</a>';
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<a type="button" class="button" href="./deletecopies.php?ISBN=' . $row[0] . '">';
                                    echo '<i class="fa fa-trash"></i>';
                                    echo '</a>';
                                    echo '</td>';

                                    echo '<td><a class="button button3" href="updatecopies.php?ISBN=' . $row[0] . '">Update Copies</a></td>';

                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            }
*/
/*
                            echo '<br/>';
                            echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Members of School with School ID:' . $school_id . '</br></span>';
                            echo '<br/>';


                            $query2 = "SELECT card_id, first_name, last_name, username, passcode, birthday, phone, email, active  FROM members 
                             where school_id=$school_id
                             ORDER BY last_name, first_name";
                            $result2 = mysqli_query($conn, $query2);

                            if (mysqli_num_rows($result2) == 0) {
                                echo '<h1 style="margin-top: 5rem;">No user found!</h1>';
                            } else {

                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Card ID</th>';
                                echo '<th>First Name</th>';
                                echo '<th>Last Name</th>';
                                echo '<th>Username</th>';
                                echo '<th>Password</th>';
                                echo '<th>Birthday</th>';
                                echo '<th>Phone</th>';
                                echo '<th>Email</th>';
                                echo '<th>Active</th>';
                                echo '<th></th>';
                                echo '<th></th>';
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
                                    echo '<td>' . $row[5] . '</td>';
                                    echo '<td>' . $row[6] . '</td>';
                                    echo '<td>' . $row[7] . '</td>';
                                    echo '<td>' . $row[8] . '</td>';
                                    //echo '<td>';
                                    echo '<td><a type="button" class="button" href="./makeinactive.php?card_id=' . $row[0] . '">';
                                    echo '<i class="fa fa-edit"></i>';
                                    echo '</td>';
                                    echo '</a>';
                                    //echo '</td>';

                                    //echo '<td>';
                                    echo '<td><a type="button" class="button" href="./deletemember.php?card_id=' . $row[0] . '">';
                                    echo '<i class="fa fa-trash"></i>';
                                    echo '</td>';
                                    echo '</a>';
                                    //echo '</td>';

                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            */
                            /*
                                echo '<br/>';
                                echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Member Applicants of School with School ID:' . $school_id . '</br></span>';
                                echo '<br />';

                                $query3 = "SELECT request_id, first_name, last_name, username, passcode, birthday, phone, email, stat FROM membership_applicant 
                                 where school_id=$school_id
                                 ORDER BY request_id";
                                $result3 = mysqli_query($conn, $query3);

                                if (mysqli_num_rows($result3) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Request ID</th>';
                                    echo '<th>First Name</th>';
                                    echo '<th>Last Name</th>';
                                    echo '<th>Username</th>';
                                    echo '<th>Password</th>';
                                    echo '<th>Birthday</th>';
                                    echo '<th>Phone</th>';
                                    echo '<th>Email</th>';
                                    echo '<th>Status</th>';
                                    echo '<th></th>';
                                    echo '<th></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result3)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '<td>' . $row[5] . '</td>';
                                        echo '<td>' . $row[6] . '</td>';
                                        echo '<td>' . $row[7] . '</td>';
                                        echo '<td>' . $row[8] . '</td>';
                                        echo '<td>';
                                        echo '<td><a type="button" class="button" href="./updatestatus.php?request_id=' . $row[0] . '">';
                                        echo '<i class="fa fa-edit"></i>';
                                        echo '</td>';
                                        echo '</a>';
                                        echo '</td>';


                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
*/
/*
                                echo '<br/>';
                                echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Reviews of Books from School with School ID:' . $school_id . '</br></span>';
                                echo '<br/>';

                                $query5 = "SELECT ISBN, r.card_id, m.username, review_text, r.active FROM reviews r, members m
                                                         where m.school_id=$school_id and r.card_id=m.card_id
                                                         ORDER BY m.username";
                                $result5 = mysqli_query($conn, $query5);

                                if (mysqli_num_rows($result5) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>ISBN</th>';
                                    echo '<th>Card ID</th>';
                                    echo '<th>username</th>';
                                    echo '<th>Review Text</th>';
                                    echo '<th>Status</th>';
                                    echo '<th></th>';
                                    echo '<th></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result5)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '<td>';

                                        echo '<td><a type="button" class="button button3" href="./updatereviews.php?ISBN=' . $row[0] . '&card_id=' . $row[1] . '">';

                                        echo '<i class="fa fa-edit"></i>';
                                        echo '</td>';
                                        echo '</a>';
                                        echo '</td>';


                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
                                echo '<br/>';
                                echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;">Reservations of Books from School with School ID:' . $school_id . '</br></span>';
                                echo '<br/>';

                                $query6 = "SELECT ISBN, r.card_id, m.username, creation_date, stat FROM reservations r, members m
                                                                 where m.school_id=$school_id and r.card_id=m.card_id
                                                                 ORDER BY creation_date";
                                $result6 = mysqli_query($conn, $query6);

                                if (mysqli_num_rows($result6) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No result!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>ISBN</th>';
                                    echo '<th>Card ID</th>';
                                    echo '<th>username</th>';
                                    echo '<th>Creation Date</th>';
                                    echo '<th>Status</th>';
                                    echo '<th></th>';
                                    echo '<th></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result6)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '<td>';

                                        echo '<td><a type="button" class="button button3" href="./updatereservations_admin.php?ISBN=' . $row[0] . '&card_id=' . $row[1] . '">';

                                        echo '<i class="fa fa-edit"></i>';
                                        echo '</td>';
                                        echo '</a>';
                                        echo '</td>';


                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }

                                echo '<span style=" font-weight:bold; font-size: 20px; color: black; text-align:center;"></br>Borrowings of School with School ID:' . $school_id . '</br></span>';

                                echo '<a type="button" class="button" href="./addborrow.php" style = "position:relative; left:-531px;">';
                                echo '<i class="fa fa-plus"></i>';
                                echo 'Add New Borrow';
                                echo '</a>';

                                $query7 = "SELECT borrow_id, b.card_id, m.username, b.ISBN, b_date, r_date, returned FROM borrows b, members m
                                                                        where m.school_id=$school_id and b.card_id=m.card_id
                                                                        ORDER BY b_date";
                                $result7 = mysqli_query($conn, $query7);

                                if (mysqli_num_rows($result7) == 0) {
                                    echo '<h1 style="margin-top: 5rem;">No user found!</h1>';
                                } else {

                                    echo '<div class="table-responsive">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Borrow ID</th>';
                                    echo '<th>Card ID</th>';
                                    echo '<th>username</th>';
                                    echo '<th>ISBN</th>';
                                    echo '<th>Borrow Date</th>';
                                    echo '<th>Return Date</th>';
                                    echo '<th>Has been returned?</th>';
                                    echo '<th></th>';
                                    echo '<th></th>';
                                    echo '<th></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_row($result7)) {
                                        echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        echo '<td>' . $row[4] . '</td>';
                                        echo '<td>' . $row[5] . '</td>';
                                        if ($row[6] == 0)
                                            echo '<td>no</td>';
                                        else echo '<td>yes</td>';

                                        echo '<td><a class="button button3" href="updateborrow.php?borrow_id=' . $row[0] . '">Register return</a></td>';


                                        echo '<td>';
                                        echo '<a type="button" class="button" href="./deleteborrow.php?borrow_id=' . $row[0] . '">';
                                        echo '<i class="fa fa-trash"></i>';
                                        echo '</a>';
                                        echo '</td>';

                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                }
                            
                            */
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>