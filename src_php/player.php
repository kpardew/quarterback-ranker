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

      
         <?php
         // display player information
         if(!($stmt = $mysqli->prepare("
               SELECT 
                  p.player_id,
                  p.first_name, 
                  p.last_name, 
                  p.uniform_number,
                  py.year,
                  t.team_name, 
                  t.nickname,
                  p.home_city,
                  p.home_state,
                  p.height,
                  p.weight
               FROM p12_player p
               INNER JOIN p12_team t ON p.team_id = t.team_id
               INNER JOIN p12_player_year py ON py.year_id = p.eligibility_year
               WHERE p.player_id = '" . $_GET["id"] . "'
            "))) {

            echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!$stmt->execute()){
            echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!($stmt->bind_result(
            $player_id, 
            $first_name, 
            $last_name, 
            $number, 
            $year, 
            $team, 
            $nickname, 
            $city, 
            $state, 
            $height, 
            $weight
         )))
         {
            echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         while($stmt->fetch()) {
            $height_feet = floor($height / 12);
            $height_inches = $height % 12;

            echo("
                 <h1>". $first_name . " " . $last_name . "</h1>\n
                 <h2>#" . $number . " | " . $year . " | " . $team . " " . $nickname . "</h2>\n
                 <h3>Hometown: " . $city . ", " . $state . "</h3>\n
                 <h3>Height: " . $height_feet . "-" . $height_inches . "</h3>\n
                 <h3>Weight: " . $weight . " lbs.</h3>\n
            ");
         }
         $stmt->close();
         ?>


         <?php
         // display season totals
         if(!($stmt = $mysqli->prepare("
               SELECT 
                  sum(passing_yards) AS total_pass_yards,
                  sum(passing_touchdowns) AS total_pass_td,
                  sum(interceptions) AS total_int
               FROM p12_player_performance
               WHERE player_id = '" . $_GET["id"] . "'
               GROUP BY player_id
            "))) {

            echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!$stmt->execute()){
            echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!($stmt->bind_result(
            $total_pass_yards,
            $total_pass_td,
            $total_int
         )))
         {
            echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         while($stmt->fetch()) {
            echo("
                 <br>
                 <h3>2015 Season</h3>\n
                 <h4>Yards: " . $total_pass_yards . "</h4>\n
                 <h4>TD: " . $total_pass_td . "</h4>\n
                 <h4>Int: " . $total_int . "</h4>\n
            ");
         }
         $stmt->close();
         ?>
            
            <br>
            <table>
               <tr>
                  <th colspan="2"></th>
                  <th colspan="5">Passing</th>
                  <th colspan="3">Rushing</th>
                  <th colspan="3">Efficiency</th>
               </tr>
               <tr>
                  <th>DATE</th>
                  <th>GAME</th>
                  <th>ATT</th>
                  <th>CMP</th>
                  <th>YDS</th>
                  <th>TD</th>
                  <th>INT</th>
                  <th>ATT</th>
                  <th>YDS</th>
                  <th>TD</th>
                  <th>PASS</th>
                  <th>RUSH</th>
                  <th>TOTAL</th>
               </tr>

               <?php
               // display game statistics
               if(!($stmt = $mysqli->prepare("
                     SELECT
                        gid,
                        game_date,
                        (
                           SELECT t.team_short_name
                           FROM p12_team t 
                           WHERE t.team_id = home_team_id
                        ) AS home_team,
                        (
                           SELECT t.team_short_name
                           FROM p12_team t 
                           WHERE t.team_id = away_team_id
                        ) AS away_team,
                        pass_att,
                        pass_comp,
                        pass_yards,
                        pass_td,
                        interceptions,
                        rush_att,
                        rush_yards,
                        rush_td,
                        passing_efficiency,
                        rushing_efficiency,
                        round((
                           (
                              (passing_efficiency * 3) + 
                              rushing_efficiency
                           ) / 4
                        ),2) AS total_efficiency
                     FROM
                     (
                        SELECT 
                           p.player_id AS pid,
                           g.game_id AS gid,
                           g.game_date AS game_date,
                           tp.home_team_id AS home_team_id,
                           tp.away_team_id AS away_team_id,
                           pp.passing_attempts AS pass_att,
                           pp.passing_completions AS pass_comp,
                           pp.passing_yards AS pass_yards,
                           pp.passing_touchdowns AS pass_td,
                           pp.interceptions AS interceptions,
                           pp.rushing_attempts AS rush_att,
                           pp.rushing_yards AS rush_yards,
                           pp.rushing_touchdowns AS rush_td,
                           round((((8.4 * pp.passing_yards) + (330 * pp.passing_touchdowns) - (200 * pp.interceptions) + (100 * pp.passing_completions)) / pp.passing_attempts),2) AS passing_efficiency,
                           IF
                           (
                              pp.rushing_attempts = 0,
                              0,
                              round((((8.4 * pp.rushing_yards) + (330 * pp.rushing_touchdowns)) / pp.rushing_attempts),2)
                           ) AS rushing_efficiency
                        FROM p12_player_performance pp
                        INNER JOIN p12_player p ON p.player_id = pp.player_id
                        INNER JOIN p12_team t ON t.team_id = p.team_id
                        INNER JOIN p12_game g ON g.game_id = pp.game_id
                        INNER JOIN p12_team_performance tp ON tp.game_id = pp.game_id
                     ) AS tbl1
                     WHERE
                        pid = '" . $_GET["id"] . "'
                     ORDER BY 
                        game_date
                  "))) {

                  echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               if(!$stmt->execute()){
                  echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               if(!($stmt->bind_result(
                  $gid,
                  $date, 
                  $home_team, 
                  $away_team, 
                  $pass_att, 
                  $pass_comp, 
                  $pass_yards, 
                  $pass_td, 
                  $interceptions, 
                  $rush_att, 
                  $rush_yards, 
                  $rush_td, 
                  $passing_efficiency, 
                  $rushing_efficiency, 
                  $total_efficiency
               )))
               {
                  echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
               }

               while($stmt->fetch()) {
                  $sql_date = strtotime($date);
                  $formatted_date = date("n/j", $sql_date);

                  echo("<tr>\n
                           <td>" . $formatted_date . "</td>\n
                           <td><a href=\"game.php?id=" . $gid . "\">" . $away_team . " @ " . $home_team . "</a></td>\n
                           <td>" . $pass_att . "</td>\n
                           <td>" . $pass_comp . "</td>\n
                           <td>" . $pass_yards . "</td>\n
                           <td>" . $pass_td . "</td>\n
                           <td>" . $interceptions . "</td>\n
                           <td>" . $rush_att . "</td>\n
                           <td>" . $rush_yards . "</td>\n
                           <td>" . $rush_td . "</td>\n
                           <td>" . $passing_efficiency . "</td>\n
                           <td>" . $rushing_efficiency . "</td>\n
                           <td>" . $total_efficiency . "</td>\n
                        </tr>\n");
               }
               ?>
            </table>

         </div>
    </div><!-- /.container -->
<?php include('footer.php'); ?>