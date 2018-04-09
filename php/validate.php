/**
  ** @brief Validates user input when logging in
	** @pre successful connection to database
	** @post user is logged in
	** @return none
  */
<?php
  require_once 'config.php';
  include_once 'header.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $check = mysqli_query($link, "SELECT * FROM GameUsers WHERE username='$username'");
    $found = mysqli_num_rows($check);

    if($found > 0) { //User exists
      if($password == mysqli_fetch_object($check)->password) {
        setcookie("user", $username, time()+(86400*10), "/");
        setcookie("pw", $password, time()+(86400*10), "/");
        header('Location: dashboard.php');
      }
      else{
        echo "<h3>That password is not correct...</h3>
              <h5><a href=\"../index.html\">Return to landing page...</a></h5>";
      }
    }
    else {
      echo "<h3>No user found with that username....</h3>
            <h5><a href=\"../index.html\">Return to landing page...</a></h5>";
    }
  }
  else {
    echo "<h3>Try logging in, doofus.</h3>
          <h5><a href=\"../index.html\">Proceed to landing page...</a></h5>";
  }
  include_once 'footer.php';
?>
