<style>
  html,
  body {
    padding: 0;
    margin: 0;
  }

  .wrap {
    font: 12px Arial, san-serif;
  }

  h1.likert-header {
    padding-left: 4.25%;
    margin: 20px 0 0;
  }

  form .statement {
    display: block;
    font-size: 14px;
    font-weight: bold;
    padding: 30px 0 0 4.25%;
    margin-bottom: 10px;
  }

  form .likert {
    list-style: none;
    width: 100%;
    margin: 0;
    padding: 0 0 35px;
    display: block;
    border-bottom: 2px solid #efefef;
  }

  form .likert:last-of-type {
    border-bottom: 0;
  }

  form .likert:before {
    content: '';
    position: relative;
    top: 11px;
    left: 9.5%;
    display: block;
    background-color: #efefef;
    height: 4px;
    width: 78%;
  }

  form .likert li {
    display: inline-block;
    width: 19%;
    text-align: center;
    vertical-align: top;
  }

  form .likert li input[type=radio] {
    display: block;
    position: relative;
    top: 0;
    left: 50%;
    margin-left: -6px;

  }

  form .likert li label {
    width: 100%;
  }

  form .buttons {
    margin: 30px 0;
    padding: 0 4.25%;
    text-align: right
  }

  form .buttons button {
    padding: 5px 10px;
    background-color: #67ab49;
    border: 0;
    border-radius: 3px;
  }

  form .buttons .clear {
    background-color: #e9e9e9;
  }

  form .buttons .submit {
    background-color: #67ab49;
  }

  form .buttons .clear:hover {
    background-color: #ccc;
  }

  form .buttons .submit:hover {
    background-color: #14892c;
  }
</style>

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

    <div class="wrap">
      <form class="form-horizontal" name="form" method="POST">
        <!--<form action="">-->
        <p><label>I like this Book.</label></p>
        <ul class='likert'>
          <li>
            <input type="radio" name="likert_id" value="5">
            <p><label>Strongly agree</label></p>
          </li>
          <li>
            <input type="radio" name="likert_id" value="4">
            <p><label>Agree</label></p>
          </li>
          <li>
            <input type="radio" name="likert_id" value="3">
            <p><label>Neutral</label></p>
          </li>
          <li>
            <input type="radio" name="likert_id" value="2">
            <p><label>Disagree</label></p>
          </li>
          <li>
            <input type="radio" name="likert_id" value="1">
            <p><label>Strongly disagree</label></p>
          </li>
        </ul>

        <!--</form>-->

        </br></br>

        <p>Write a Review</p>
        <input type="text" name="review_text" value="" id="myInput">

        </br></br>
        <button class="button" type="submit" name="submit_review">Submit</button>

      </form>

      <?php

      $ISBN = $_GET['ISBN'];
      $user_data['card_id'] = $_SESSION['card_id'];
      $card_id = $user_data['card_id'];

      //echo $card_id, $ISBN;
      if (isset($_POST['submit_review'])) {

        $likert_id = $_POST['likert_id'];
        $review_text = $_POST['review_text'];

        try {
          $query = "INSERT INTO reviews (ISBN, card_id, review_text, likert_id)
                 VALUES ('$ISBN', '$card_id', '$review_text', '$likert_id')";

          if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
            exit();
          } else {
            echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
          }
        } catch (exception $e) {
          echo $e->getMessage();
        }
      }

      ?>

    </div>

    <br /><br /><br />
    <div type="text" style="text-align: center;">
      <a href="student.php" class="button button3">Back</a>
    </div>

  </div>

</body>

</html>