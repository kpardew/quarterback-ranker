<?php include('header.php'); ?>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li class="active"><a href="players.php">Players</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="games.php">Games</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">

         <div>
            <form method="post" action="filter_players_team.php">
               <fieldset>
                  <legend>Filter By Team</legend>
                     <select name="Team">
                        <?php
                        // display team name in option tags
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              team_id, 
                              team_name
                           FROM p12_team
                           ORDER BY team_name
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
                         echo '<option value=" '. $team_id . ' "> ' . $team_name . '</option>\n';
                        }
                        $stmt->close();
                        ?>
                     </select>
                     <input type="submit" value="Run Filter" />
               </fieldset>
            </form>
         </div>
         <br>
         <div>
            <form method="post" action="filter_players_state.php">
               <fieldset>
                  <legend>Filter By Home State</legend>
                     <select name="State">
                        <?php
                        // display home state in option tags
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              home_state
                           FROM p12_player
                           GROUP BY home_state
                           ORDER BY home_state
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $state
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo '<option value="'. $state . '"> ' . $state . '</option>\n';
                        }
                        $stmt->close();
                        ?>
                     </select>
                     <input type="submit" value="Run Filter" />
               </fieldset>
            </form>
         </div>
         <br>
         <div>
            <form method="post" action="filter_players_year.php">
               <fieldset>
                  <legend>Filter By Year</legend>
                     <select name="Year">
                        <?php
                        // display player year in option tags
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              year_id,
                              year
                           FROM p12_player_year
                           ORDER BY year_id
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $year_id,
                           $year
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo '<option value=" '. $year_id . ' "> ' . $year . '</option>\n';
                        }
                        $stmt->close();
                        ?>
                     </select>
                     <input type="submit" value="Run Filter" />
               </fieldset>
            </form>
         </div>
         <br>
         <div id="header">     

            <table>
               <tr>
                  <th>NAME</th>
                  <th>TEAM</th>
                  <th>#</th>
                  <th>YEAR</th>
                  <th>CITY</th>
                  <th>STATE</th>
                  <th>HEIGHT</th>
                  <th>WEIGHT</th>
               </tr>
               <?php
               // display player information
               if(!($stmt = $mysqli->prepare("
                  SELECT
                     p.player_id,
                     t.team_id,
                     t.team_short_name,
                     p.first_name,
                     p.last_name,
                     p.uniform_number,
                     py.year,
                     p.home_city,
                     p.home_state,
                     p.height,
                     p.weight
                  FROM p12_player p
                  INNER JOIN p12_team t on t.team_id = p.team_id
                  INNER JOIN p12_player_year py on py.year_id = p.eligibility_year
                  ORDER BY first_name
               "))) {

                  echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               if(!$stmt->execute()){
                  echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               if(!($stmt->bind_result(
                  $player_id,
                  $team_id,
                  $team_name,
                  $fname, 
                  $lname,
                  $number,
                  $year,
                  $city,
                  $state,
                  $height,
                  $weight
               ))){
                  echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               while($stmt->fetch()) {
                  $height_feet = floor($height / 12);
                  $height_inches = $height % 12;
                  echo("<tr>\n
                        <td><a href=\"player.php?id=". $player_id . "\">" . $fname . " " . $lname . "</a></td>\n
                        <td><a href=\"team.php?id=" . $team_id . "\">" . $team_name . "</a></td>\n
                        <td>" . $number . "</td>\n
                        <td>" . $year . "</td>\n
                        <td>" . $city . "</td>\n
                        <td>" . $state . "</td>\n
                        <td>" . $height_feet . "-" . $height_inches . "</td>\n
                        <td>" . $weight . "</td>\n
                     </tr>\n");
               }
               $stmt->close();
               ?>
            </table>

         </div>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>