<?php include('header.php'); ?>
<?php include('states.php'); ?>
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

            <form action = "process_player_performance.php" method = "post">
               <fieldset>
                  <legend> Add Player Performance - Step 2</legend>
                  <?php
                  // display player name
                  if(!($stmt = $mysqli->prepare("
                     SELECT 
                        first_name,
                        last_name
                     FROM p12_player
                     WHERE player_id = '" . $_POST['player'] . "'
                  "))){
                     echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                  }

                  if(!$stmt->execute()){
                     echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                  }
                  if(!$stmt->bind_result(
                     $fname,
                     $lname
                  )){
                     echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                  }
                  while($stmt->fetch()){
                   echo "<p class=\"lead\">Player Name: " . $fname . " " . $lname .  "</year>\n";
                   echo "<input type=\"hidden\" name=\"player\" value=\"" . $_POST['player'] . "\">\n";
                   echo "<input type=\"hidden\" name=\"fname\" value=\"" . $fname . "\">\n";
                   echo "<input type=\"hidden\" name=\"lname\" value=\"" . $lname . "\">\n";
                  }
                  $stmt->close();
                  ?>
                  <p> Game:
                     <select name="game">
                     <?php
                     // display game information in option tag
                     if(!($stmt = $mysqli->prepare("
                        SELECT
                           gid, 
                           (
                              SELECT t.team_name
                              FROM p12_team t 
                              WHERE t.team_id = home_team_id
                           ) AS home_team,
                           (
                              SELECT t.team_name
                              FROM p12_team t 
                              WHERE t.team_id = away_team_id
                           ) AS away_team
                           FROM
                           (
                              SELECT
                                 tg.game_id as gid,
                                 tg.home_team_id as home_team_id,
                                 tg.away_team_id as away_team_id
                              FROM p12_team_performance tg
                              WHERE 
                                 tg.home_team_id = 
                                 (
                                    SELECT team_id
                                    FROM p12_player
                                    WHERE player_id = '" . $_POST['player'] . "'
                                 )
                                 OR
                                 tg.away_team_id = 
                                 (
                                    SELECT team_id
                                    FROM p12_player
                                    WHERE player_id = '" . $_POST['player'] . "'
                                 )
                           ) as tbl1
                           ORDER BY gid
                     "))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                     }

                     if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                     }
                     if(!$stmt->bind_result(
                        $game_id,
                        $home_team,
                        $away_team
                     )){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                     }
                     while($stmt->fetch()){
                      echo "<option value='". $game_id . "'>" . $away_team . " @ " . $home_team . "</option>\n";
                     }
                     $stmt->close();
                     ?>
                     </select>
                  </p>
                  <p> Passing Attempts: <input type ="number" size="2" name="pass_att" required min="0"></p>
                  <p> Passing Completions: <input type ="number" size="2" name="pass_comp" required min="0"></p>
                  <p> Passing Yards: <input type ="number" size="3" name="pass_yds" required></p>
                  <p> Interceptions: <input type ="number" size="2" name="int" required min="0"></p>
                  <p> Passing Touchdowns: <input type ="number" size="2" name="pass_td" required min="0"></p>
                  <p> Rushing Attempts: <input type ="number" size="2" name="rush_att" required min="0"></p>
                  <p> Rushing Yards: <input type ="number" size="3" name="rush_yds" required></p>
                  <p> Rushing Touchdowns: <input type ="number" size="2" name="rush_td" required min="0"></p>
                  <p><input type="submit" value = "Add Player Performance"></p>
               </fieldset>
            </form>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>