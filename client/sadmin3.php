<!DOCTYPE html>

<head>
<title lang='gr'>Βιβλιοθήκη ΕΜΠ - Βάση Δεδομένων</title>
           <link rel='icon' href='prometheus.png' type='image/png'/>
           <meta name='viewport' content='width=device-width, initial-scale=1.0'></meta>
           <meta name='author' content='Κωνσταντίνα Παπία, Παρασκευή Κασιούμη'></meta>
           <meta charset="UTF-8"></meta>
           <link rel='stylesheet' href='common.css'></link>
 
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
       
           <br/>
           <br/>

           <div class="main-content2">

       
    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        include 'connection.php';
                        $conn = OpenCon();

                            //echo "<h2>$year</h2>";
                            //echo "<h2>$month</h2>";
                        
                            /* New code*/

                        $query =  "SELECT a.card_id, first_name, last_name, year(CURRENT_DATE())-year(birthday) as age, COUNT(*) as count
                        FROM members as a, borrows as b
                        WHERE teacher=1 AND year(CURRENT_DATE())-year(birthday)<40 AND a.card_id=b.card_id
                        GROUP BY a.card_id
                        ORDER BY count DESC";

                        /*End of new code */
                        
                        //"SELECT * FROM students";
                        
                        $result = mysqli_query($conn, $query);
                    
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No borrowed books found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                        /* New code */
                                        echo '<th>card_id</th>';
                                        /* End of new code*/
                                            echo '<th>Teacher First Name</th>';
                                            echo '<th>Teacher Last Name</th>';
                                            echo '<th>Age</th>';
                                            echo '<th>Number of Books</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            /* New code */
                                            echo '<td>' . $row[4] . '</td>';
                                        /* End of new code*/
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