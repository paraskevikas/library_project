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

                                    $query =  "SELECT a.category_name AS cat1, b.category_name AS cat2, sum(a.total)
                                    FROM pop_cat a
                                    JOIN pop_cat b
                                    ON a.category_name < b.category_name AND a.ISBN = b.ISBN
                                    GROUP BY 1,2  
                                    ORDER BY `sum(a.total)` DESC LIMIT 3";
                        
                        
                        $result = mysqli_query($conn, $query);
                    
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No borrowed books found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Category 1</th>';
                                            echo '<th>Category 2</th>';
                                            echo '<th>Times shown</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
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
                        
                        
                        ?>          
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</div>
</body>

</html>