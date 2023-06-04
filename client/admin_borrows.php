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

                            ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </body>
    
    </html>