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
        <p> First Name </p>
      </label>
      <input type="text" , placeholder="Enter your First Name" , name="first_name">

      <label class="form-label">
        <p> Last Name </p>
      </label>
      <input type="text" , placeholder="Enter your Last Name" , name="last_name">

      <label class="form-label">
        <p> Username </p>
      </label>
      <input type="text" , placeholder="Enter your Userame" , name="username">

      <label class="form-label">
        <p> Password </p>
      </label>
      <input type="text" , placeholder="Enter your Password" , name="passcode">

      <label class="form-label">
        <p> Birthday </p>
      </label>
      <input type="text" , placeholder="Enter your Birthday e.g. 2000-01-01" , name="birthday">

      <label class="form-label">
        <p> Phone Number </p>
      </label>
      <input type="text" , placeholder="Enter your Phone Number" , name="phone">

      <label class="form-label">
        <p> Email </p>
      </label>
      <input type="text" , placeholder="Enter your Email e.g. user@mail.com" , name="email">

      <label class="form-label">
        <p> Student or Teacher? </p>
      </label>
      <select id="teacher" name="teacher">
        <option value="">Are you a Teacher?</option>
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>

      <label class="form-label">
        <p> School </p>
      </label>
      <?php

      include 'connection.php';
      $conn = OpenCon();

      echo '<select id="school_id" name="school_id">';

      $query = "SELECT school_id, school_name
      FROM schools";

      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 0) {
        echo '<h1 style="margin-top: 5rem;">An error occured!</h1>';
      } else {
        echo '<option value="0">Choose your School</option>';
        while ($row = mysqli_fetch_row($result)) {
          echo '<option value=' . $row[0] . '>' . $row[1] . '</option>';
        }
        echo '</select>';
      }
      ?>
      <br />
      <br />

      <button class="button button3" type="submit" name="submit_creds">Submit</button>
      <!--<button class="button button3" formaction="home.php">Back</button>-->

    </form>

    <div class="container1">
      <?php


      if (isset($_POST['submit_creds'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $passcode = $_POST['passcode'];
        $birthday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $teacher = $_POST['teacher'];
        $school_id = $_POST['school_id'];

        if ($_POST['teacher'] == "Yes") {
          $teacher = 1;
        } else {
          $teacher = 0;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<hr>Invalid email format, please try again';
        } else if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($passcode) && (validateDate($birthday)) && !empty($phone) && !empty($school_id)) {
          try {
            $query = "INSERT INTO membership_applicant (first_name, last_name, username, passcode, birthday, phone, email, teacher, school_id)
                                VALUES ('$first_name', '$last_name', '$username', '$passcode', '$birthday', '$phone', '$email', '$teacher', '$school_id')";
            if (mysqli_query($conn, $query)) {
              echo "<hr>New record created successfully";
              exit();
            } else {
              echo "<hr>Error while creating record: <br>" . mysqli_error($conn) . "<br>";
            }
          } catch (exception $e) {
            echo '<p>' . $e->getMessage() . '</p>';
          }
        } else {
          echo '<hr>No valid information!';
        }
      }

      ?>
      <br /><br /><br /><br />
    </div>
  </div>
  </div>
  </div>
  </div>
</body>

</html>