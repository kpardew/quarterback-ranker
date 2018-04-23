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
          // variable to store the game id
          $new_game_id = 0;

          // insert into game table
          if(!($stmt = $mysqli->prepare("
             INSERT INTO p12_game(
                game_week,
                game_date,
                attendance) 
             VALUES (?,?,?)")))
          {
             echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("isi",
             $_POST['week'],
             $_POST['date'],
             $_POST['attendance'])))
          {
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
             echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
          } 
          $stmt->close();

          // get new game id
          if(!($stmt = $mysqli->prepare("
             SELECT MAX(game_id)
             FROM p12_game
          "))){
             echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }

          if(!$stmt->execute()){
             echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result(
             $gid
          )){
             echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
             $new_game_id = $gid;
          }
          $stmt->close();

          // insert into team performance table
          if(!($stmt = $mysqli->prepare("
               INSERT INTO p12_team_performance(
                 game_id,
                 home_team_id,
                 away_team_id,
                 home_team_points,
                 away_team_points,
                 home_team_yards,
                 away_team_yards)
               VALUES (?,?,?,?,?,?,?)")))
          {
             echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("iiiiiii",
             $new_game_id,
             $_POST['home_team'],
             $_POST['away_team'],
             $_POST['home_team_points'],
             $_POST['away_team_points'],
             $_POST['home_team_yards'],
             $_POST['away_team_yards'])))
          {
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
             echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
          } else {
             echo ("<h3>The game was added successfully!</h3>");
             echo ("<p><a href=\"games.php\">View all games</p>");
          }
          $stmt->close();
        ?>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>