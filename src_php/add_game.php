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

            <form action = "process_game.php" method = "post">
               <fieldset>
                  <legend> Add 2015 Pac-12 Championship Game</legend>
                  <h3>Saturday, December 5, 2015</h3>
                  <h3>4:45 PM</h3>
                  <input type="hidden" name="week" value="14">
                  <input type="hidden" name="date" value="2015-12-05 16:45:00">
                  <p> Home Team:
                     <select name="home_team">                        
                        <?php
                        // display home team name in option tag
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              team_id, 
                              team_name
                           FROM p12_team
                           ORDER BY 
                              team_name
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $team_id, 
                           $team_name
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo "<option value='". $team_id . "'>" . $team_name .  "</p>\n";
                        }
                        $stmt->close();
                        ?>
                     </select>
                  </p>
                  <p> Home Team Points: <input type="number" name="home_team_points" size="3" required min="0"></p>
                  <p> Home Team Yards: <input type="number" name="home_team_yards" size="3" required min="0"></p>
                  <p> Away Team:
                     <select name="away_team">                        
                        <?php
                        // display away team name in option tag
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              team_id, 
                              team_name
                           FROM p12_team
                           ORDER BY 
                              team_name
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $team_id, 
                           $team_name
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo "<option value='". $team_id . "'>" . $team_name .  "</p>\n";
                        }
                        $stmt->close();
                        ?>
                     </select>
                  </p>
                  <p> Away Team Points: <input type="number" name="away_team_points" size="3" required min="0"></p>
                  <p> Away Team Yards: <input type="number" name="away_team_yards" size="3" required min="0"></p>
                  <p> Attendance: <input type="number" name="attendance" size="5" required min="0"></p>
                  <p><input type="submit" value = "Add Game"></p>
               </fieldset>
            </form>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>