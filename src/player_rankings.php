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
        <h1>2015 Pac-12 Quarterback Rankings</h1>
        <table>
           <tr>
              <th colspan="2"></th>
              <th colspan="5">Passing</th>
              <th colspan="3">Rushing</th>
              <th colspan="3">Efficiency</th>
              <th colspan="2">Team</th>
              <th colspan="2">TER</th>
           </tr>
           <tr>
              <th>NAME</th>
              <th>TEAM</th>
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
              <th>POINT %</th>
              <th>WIN %</th>
              <th>RAW</th>
              <th>ADJUSTED</th>
           </tr>

          <?php
          // display players ranked by TER
          if(!($stmt = $mysqli->prepare("
             SELECT
                p.player_id,
                p.first_name,
                p.last_name,
                t.team_id,
                t.team_short_name,
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
                total_efficiency,
                point_share,
                team_win_percentage,
                round((total_efficiency * point_share),2) AS raw_ter,
                round((total_efficiency * point_share * team_win_percentage),2) AS adj_ter
             FROM
             (
                SELECT
                   pid,
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
                         (passing_efficiency * 4) + 
                         rushing_efficiency
                      ) / 5
                   ),2) AS total_efficiency,
                   round((total_points/team_points),2) AS point_share,
                   round((team_wins / (team_wins + team_losses)),3) AS team_win_percentage
                FROM
                (
                   SELECT
                      pid,
                      pass_att,
                      pass_comp,
                      pass_yards,
                      pass_td,
                      interceptions,
                      rush_att,
                      rush_yards,
                      rush_td,   
                      round((((8.4 * pass_yards) + (330 * pass_td) - (200 * interceptions) + (100 * pass_comp)) / pass_att),2) AS passing_efficiency,
                      IF
                      (
                         rush_att = 0,
                         0,
                         round((((8.4 * rush_yards) + (330 * rush_td)) / rush_att),2)
                      ) AS rushing_efficiency,  
                      ((pass_td + rush_td) * 6) as total_points,
                      sr.wins as team_wins,
                      sr.losses as team_losses,
                      sr.points as team_points
                   FROM
                   (
                      SELECT 
                         pp.player_id AS pid,
                         SUM(pp.passing_attempts) AS pass_att,
                         SUM(pp.passing_completions) AS pass_comp,
                         SUM(pp.passing_yards) AS pass_yards,
                         SUM(pp.passing_touchdowns) AS pass_td,
                         SUM(pp.interceptions) AS interceptions,
                         SUM(pp.rushing_attempts) AS rush_att,
                         SUM(pp.rushing_yards) AS rush_yards,
                         SUM(pp.rushing_touchdowns) AS rush_td
                      FROM p12_player_performance pp
                      GROUP BY pid
                   ) as tbl1
                   INNER JOIN p12_player p ON p.player_id = pid
                   INNER JOIN p12_team t ON t.team_id = p.team_id
                   INNER JOIN p12_season_results sr ON sr.team_id = t.team_id
                ) as tbl2
             ) as tbl3
             INNER JOIN p12_player p ON p.player_id = pid
             INNER JOIN p12_team t ON t.team_id = p.team_id
             ORDER BY adj_ter DESC
          "))) {

             echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!$stmt->execute()){
             echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!($stmt->bind_result(
             $player_id,
             $fname, 
             $lname, 
             $tid,
             $team, 
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
             $total_efficiency,
             $point_share,
             $team_win_percentage,
             $raw_ter,
             $adj_ter
          ))){
             echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          while($stmt->fetch()) {
             echo("<tr>\n
                   <td><a href=\"player.php?id=". $player_id . "\">" . $fname . " " . $lname . "</a></td>\n
                   <td><a href=\"team.php?id=" . $tid . "\">" . $team . "</a></td>\n
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
                   <td>" . $point_share . "</td>\n
                   <td>" . $team_win_percentage . "</td>\n
                   <td>" . $raw_ter . "</td>\n
                   <td>" . $adj_ter . "</td>\n
                </tr>\n");
          }
          $stmt->close();
          ?>
        </table>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>