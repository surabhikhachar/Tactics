
<?php
/**
  ** @brief Goes to this page if login is successful
	** @pre Valid login
	** @post Takes user to the dashboard
	** @return None
  */


$username = $_COOKIE["user"];
$password = $_COOKIE["pw"];
?>

<div class="row">
  <div class="col-sm-4">
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Local Play</h2></div>
        <div class="panel-body">
          <p>
            <h4>Play with a friend at the same computer!</h4>
          </p>
          <a href="/Tactics/html/simpleBoard.html"><button type="button" class="btn btn-default btn-lg" id="3x3Butt">3 x 3 Board</button></a><a href="../html/ninerBoard.html"><button type="button" class="btn btn-default btn-lg" id="9x9butt">9 x 9 Board</button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Player Vs. Bot</h2></div>
        <div class="panel-body">
          <p>
            <h4>Play against a bot of your choice!</h4>
          </p>
          <a href="/Tactics/demos/singleBoardBotDemo/easy/simpleBoard.html"><button type="button" class="btn btn-default btn-lg" id="3x3Butt">3 x 3 Easy</button></a>
          <a href="/Tactics/demos/nineBoardBotDemo/easy/ninerBoard.html"><button type="button" class="btn btn-default btn-lg" id="9x9butt">9 x 9 Easy</button></a>
          <br>
          <a href="/Tactics/demos/singleBoardBotDemo/medium/simpleBoard.html"><button type="button" class="btn btn-default btn-lg" id="3x3Butt">3 x 3 Medium</button></a>
          <a href="/Tactics/demos/nineBoardBotDemo/medium/ninerBoard.html"><button type="button" class="btn btn-default btn-lg" id="9x9butt">9 x 9 Medium</button></a>
          <br>
          <a href="/Tactics/demos/singleBoardBotDemo/hard/simpleBoard.html"><button type="button" class="btn btn-default btn-lg" id="3x3Butt">3 x 3 Hard</button></a>
          <a href="/Tactics/demos/nineBoardBotDemo/hard/ninerBoard.html"><button type="button" class="btn btn-default btn-lg" id="9x9butt">9 x 9 Hard</button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Player Vs. Player</h2></div>
        <div class="panel-body">

          <?php
          if($_COOKIE["user"] != ""){
            echo "<p>
                    <h4>Play against a friend online (coming soon!)</h4>
                  </p>
                  <button type=\"button\" class=\"btn btn-default btn-lg\">Coming Soon</button>";
          }
          else {
            echo "<p>
                    <h4>Play against a friend online!<br>(Must be logged in)</h4>
                  </p>
                  <a href=\"/Tactics/html/login.html\"></a><button type=\"button\" class=\"btn btn-default btn-lg\">Click here to log in</button>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
