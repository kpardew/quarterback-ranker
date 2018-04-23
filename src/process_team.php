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
          $new_team_id = 0;

          // insert into team table
          if(!($stmt = $mysqli->prepare("
             INSERT INTO p12_team(
               institution, 
               team_name,
               team_short_name,
               nickname,
               city,
               state,
               stadium_name,
               capacity,
               division) 
             VALUES (?,?,?,?,?,?,?,?,?)")))
          {
             echo "Team Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("sssssssis",
             $_POST['institution'],
             $_POST['team_name'],
             $_POST['team_short_name'],
             $_POST['nickname'],
             $_POST['city'],
             $_POST['state'],
             $_POST['stadium'],
             $_POST['capacity'],
             $_POST['division'])))
          {
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
             echo ("<h3>" . $_POST['team_name'] . " already exists in the database!</h3>");
             echo ("<p><a href=\"add_team.php\">Add another team</p>");
          } 
          else {

            // get new team id
            if(!($stmt2 = $mysqli->prepare("
               SELECT MAX(team_id)
               FROM p12_team
            "))){
               echo "Team ID Prepare failed: "  . $stmt->errno . " " . $stmt->error;
            }

            if(!$stmt2->execute()){
               echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
            }
            if(!$stmt2->bind_result(
               $tid
            )){
               echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
            }
            while($stmt2->fetch()){
               $new_team_id = $tid;
            }
            $stmt2->close();

            // insert into season results table
            if(!($stmt2 = $mysqli->prepare("
                 INSERT INTO p12_season_results(
                   team_id,
                   season,
                   wins,
                   losses,
                   points)
                 VALUES (?,?,?,?,?)")))
            {
               echo "Season Prepare failed: "  . $stmt->errno . " " . $stmt->error;
            }
            if(!($stmt2->bind_param("iiiii",
               $new_team_id,
               $_POST['season'],
               $_POST['wins'],
               $_POST['losses'],
               $_POST['points'])))
            {
               echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
            }
            if(!$stmt2->execute()){
               echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
            } else {
               echo ("<h3>" . $_POST['team_name'] . " and its " . $_POST['season'] . " season info was added successfully!</h3>");
               echo ("<p><a href=\"teams.php\">View all teams</p>");
            }
            $stmt2->close();
          }
          $stmt->close();
        ?>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>