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


    <div class="container">

            <div class="row" id="row">
                <div class="col-md-12">
                    <div class="card" id="card-container">
                        <div class="card-body" id="card">
                            <?php



                            $user_data['school_id'] = $_SESSION['school_id'];
                            $school_id = $user_data['school_id'];

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


                            ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </body>
    
    </html>