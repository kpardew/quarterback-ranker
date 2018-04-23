<?php include('header.php'); ?>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="games.php">Games</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">

        <?php
        // insert form data into player performance table
          if(!($stmt = $mysqli->prepare("
             INSERT INTO p12_player_performance(
                game_id,
                player_id,
                passing_attempts,
                passing_completions,
                passing_yards,
                passing_touchdowns,
                interceptions,
                rushing_attempts,
                rushing_yards,
                rushing_touchdowns) 
             VALUES (?,?,?,?,?,?,?,?,?,?)")))
          {
             echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("iiiiiiiiii",
             $_POST['game'],
             $_POST['player'],
             $_POST['pass_att'],
             $_POST['pass_comp'],
             $_POST['pass_yds'],
             $_POST['pass_td'],
             $_POST['int'],
             $_POST['rush_att'],
             $_POST['rush_yds'],
             $_POST['rush_td'])))
          {
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
             echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
          } else {
             echo ("<h3>Added new performance for " . $_POST['fname'] . " " . $_POST['lname'] . " successfully!</h3>");
             echo ("<p><a href=\"players.php\">View all players</p>");
          }
          $stmt->close();
        ?>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>