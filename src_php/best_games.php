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
        <h1>2015 Pac-12 Top 25 Quarterback Performances</h1>
        <table>
           <tr>
              <th colspan="3"></th>
              <th colspan="5">Passing</th>
              <th colspan="3">Rushing</th>
              <th colspan="3">Efficiency</th>
           </tr>
           <tr>
              <th>NAME</th>
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
          // display top 25 games of the season
          if(!($stmt = $mysqli->prepare("
             SELECT
                pid,
                gid,
                fname,
                lname,
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
                   p.first_name AS fname,
                   p.last_name AS lname,
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
                   round((((8.4 * pp.passing_yards) + (330 * pp.passing_touchdowns) - (200 * pp.interceptions) + (100 * pp.passing_completions)) / pp.passing_attempts),2) AS passing_efficiency,IF
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
             ORDER BY total_efficiency DESC
             LIMIT 25
          "))) {

             echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!$stmt->execute()){
             echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!($stmt->bind_result(
             $player_id,
             $game_id,
             $fname, 
             $lname, 
             $game_date,
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
          ))){
             echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          while($stmt->fetch()) {
             $sql_date = strtotime($game_date);
             $formatted_date = date("n/j", $sql_date);
             echo("<tr>\n
                    <td><a href=\"player.php?id=". $player_id . "\">" . $fname . " " . $lname . "</a></td>\n
                    <td>" . $formatted_date . "</td>\n
                    <td><a href=\"game.php?id=" . $game_id . "\">" . $away_team . " @ " . $home_team . "</a></td>\n
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
          $stmt->close();
          ?>
        </table>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>