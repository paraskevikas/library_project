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
        <p> ISBN </p>
      </label>
      <input type="text" , placeholder="Enter ISBN" , name="ISBN">

      <label class="form-label">
        <p> Title </p>
      </label>
      <input type="text" , placeholder="Enter Title" , name="title">

      <label class="form-label">
        <p> Language </p>
      </label>
      <input type="text" , placeholder="Enter Language" , name="lang">

      <label class="form-label">
        <p> Number of Pages </p>
      </label>
      <input type="text" , placeholder="Enter Number of Pages" , name="page_number">

      <label class="form-label">
        <p> Publisher </p>
      </label>
      <input type="text" , placeholder="Enter Publisher" , name="publisher">

      <label class="form-label">
        <p> Total Copies </p>
      </label>
      <input type="text" , placeholder="Enter Number of Copies" , name="total_copies">


      <br />
      <br />

      <button class="button button3" type="submit" name="submit_creds">Submit</button>
      <!--<button class="button button3" formaction="home.php">Back</button>-->

    </form>
  </div>
  <div class="container1">
    <?php
    include 'connection.php';
    $conn = OpenCon();

    session_start();

    $school_id = $_SESSION['school_id'];

    if (isset($_POST['submit_creds'])) {
      $ISBN = $_POST['ISBN'];
      $title = $_POST['title'];
      $lang = $_POST['lang'];
      $page_number = $_POST['page_number'];
      $publisher = $_POST['publisher'];
      $total_copies = $_POST['total_copies'];



      if (!empty($ISBN) && !empty($total_copies) && !empty($title) && !empty($lang) && !empty($page_number) && !empty($publisher) && !empty($total_copies)) {

        $query = "SELECT ISBN FROM books WHERE ISBN = '$ISBN'";
        $result = mysqli_query($conn, $query);


        if ($result && mysqli_num_rows($result) == 0) {

        try {
            $query = "INSERT INTO books (ISBN, title, lang, page_number, publisher)
                                      VALUES ('$ISBN', '$title', '$lang', '$page_number', '$publisher')";

            if (mysqli_query($conn, $query)) {
              echo "<hr>New record created successfully";
            } else {
              echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
            }
          } catch (exception $e) {
            echo '<p>' . $e->getMessage() . '</p>';
          }
        }

        try {

          $query = "INSERT INTO copies (ISBN, total_copies, school_id)
                                      VALUES ('$ISBN', '$total_copies', $school_id)";

          if (mysqli_query($conn, $query)) {
            echo "<hr>New record created successfully";
            header("Location: admin.php");
          } else {
            echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
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
</body>

</html>