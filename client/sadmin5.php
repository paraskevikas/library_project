<!DOCTYPE html>

<html>

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

                        /* New code*/
                        $query =  "SELECT a.admin_id, a.first_name, a.last_name, a.books, a.year
                                    FROM admin_lends a
                                    INNER JOIN admin_lends a2 ON a.admin_id <> a2.admin_id
                                    WHERE a.books = a2.books;";

                        /* ENd of new code*/
                        
                        $result = mysqli_query($conn, $query);
                    
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No borrowed books found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Admin ID</th>';
                                            echo '<th>Administrator First Name</th>';
                                            echo '<th>Administrator Last Name</th>';
                                            echo '<th>Number of Lendings</th>';
                                            echo '<th>Year</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
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
                        
                        
                        ?>          
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    
                    </div>
</body>

</html>