<?php
  require_once 'config.php';
  include_once 'header.php';

  if($_COOKIE["user"] != ""){
    $username = $_COOKIE["user"];
    $password = $_COOKIE["pw"];

    $check = mysqli_query($link, "SELECT * FROM GameUsers WHERE username='$username'");
    $found = mysqli_num_rows($check);

    if($found > 0) { //User exists
      if($password == mysqli_fetch_object($check)->password) {
        include 'rankings.php';
        echo "<h1>Login successful! Welcome $username !</h1>";
        include 'dashboardSuccess.php';
      }
      else{
        echo "<h3>Error accessing credentials...</h3>
              <h5><a href=\"../index.html\">Return to landing page...</a></h5>";
      }
    }
    else {
      echo "<h3>Error accessing credentials....</h3>
            <h5><a href=\"../index.html\">Return to landing page...</a></h5>";
    }
  }
  else {
    echo "<h3>Try logging in, doofus.</h3>
          <h5><a href=\"../index.html\">Proceed to landing page...</a></h5>";
  }
  include_once 'footer.php';
?>
