<?php
/**
  ** @brief Add html lines at the beginning of the php file to make it readable for browser
	** @pre none
	** @post none
	** @return None
  */

  require 'dirtracker.php';
  require_once 'config.php';

  $sessionUsr = $_COOKIE["user"];
  $password   = $_COOKIE["pw"];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tactics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href= <?php echo getDirectoryEscape()."css/index.css"; ?> >

    <?php
      $loadRules = false;

      //Get the game rules and styling (JS and CSS) files based on the URI and HTML file.
      $boardType = basename($_SERVER['REQUEST_URI'],'.php'); //gets name of URI file (file the URI begins building site with)
      if($boardType == "simpleBoard" || $boardType == "ninerBoard" || $boardType == "continueThrees" || $boardType == "botGame" || $boardType == "continueNines") {
        //echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".getDirectoryEscape()."css/simpleStyle.css\">";
        $loadRules = true;
      }
      // elseif($boardType == "ninerBoard") {
        //echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".getDirectoryEscape()."css/ninerStyle.css\">";
        // $loadRules = true;
      // }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body <?php if($loadRules) echo "onload=\"addEvents()\""; ?>>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href= <?php echo $diradder."#"; ?> >Tactics</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href=<?php echo getDirectoryEscape()."#"; ?> >Home</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Social Media<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ul>
          </li>
        </ul>
<?php
  if($sessionUsr != "") include_once 'loggedin.php';
  else include_once 'loggedout.php';
?>
