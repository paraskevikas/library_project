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
    <form class="form-horizontal" name="form" method="POST">

  <label class = "form-label">
    <p> Select Category</p>
    </label>
  <select id="category" name="category">
  <option value="0">Select Category</option>
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

       
        
  <br/>
  <br/>

  <button class="button button3" type="submit" name="submit_creds">Search</button>
</form>

<br/>
<br/>

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        include 'connection.php';
                        $conn = OpenCon();

                        if(isset($_POST['submit_creds'])){
                            $category = $_POST['category'];

                            /* New code*/
                        $query1 =  "SELECT DISTINCT category_name, b.author_id, b.first_name, b.last_name
                        FROM categories as a, authors as b
                        WHERE a.ISBN=b.ISBN AND category_name='$category'
                        ORDER BY b.last_name, b.first_name";
          
                        $query2 = "SELECT DISTINCT category_name, m.card_id, m.first_name, m.last_name, (year(b.b_date)) as year
                        FROM categories c
                        INNER JOIN borrows b ON b.ISBN = c.ISBN
                        INNER JOIN members m ON m.card_id = b.card_id
                        WHERE category_name = '$category' AND m.teacher = 1 AND year(b.b_date) = (SELECT MAX(year(b_date)) from borrows)
                        ORDER BY m.last_name, m.first_name";
                        /*End of new code*/

                        $result1 = mysqli_query($conn, $query1);
                        $result2 = mysqli_query($conn, $query2);
                    
                        if(mysqli_num_rows($result1) == 0 AND mysqli_num_rows($result2) == 0){
                            echo '<h1 style="margin-top: 5rem;">No result found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Book Category</th>';
                                            /*New code*/
                                            echo '<th>author_id</th>';
                                            /*End of new code*/
                                            echo '<th>Author first name</th>';
                                            echo '<th>Author last name</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result1)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            /*New code*/
                                            echo '<td>' . $row[3] . '</td>';
                                            /*End of new code*/
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';

                            echo '</br>';
                            echo '</br>';

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Book Category</th>';
                                    /*New code*/
                                    echo '<th>card_id</th>';
                                    /*End of new code*/
                                    echo '<th>Teacher first name</th>';
                                    echo '<th>Teacher last name</th>';
                                    echo '<th>Latest year</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result2)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
                                        echo '<td>' . $row[3] . '</td>';
                                        /*New code*/
                                        echo '<td>' . $row[4] . '</td>';
                                        /*End of new code*/
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
    </div>

</div>

</body>

</html>