<?php include('header.php'); ?>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li class="active"><a href="games.php">Games</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
         
        <p><a href="games.php">View all Games</a></p>

        <table>
           <tr>
              <th>DATE</th>
              <th>WEEK</th>
              <th>GAME</th>
              <th>STADIUM</th>
              <th>CAPACITY</th>
              <th>ATTENDANCE</th>
           </tr>

          <?php
          // display game information
          if(!($stmt = $mysqli->prepare("
             SELECT
             gid,
             game_date,
             game_week,
             (      
                SELECT t.team_name
                FROM p12_team t 
                WHERE t.team_id = home_team_id
             ) AS home_team,
             home_team_points,
             (
                SELECT t.team_name
                FROM p12_team t 
                WHERE t.team_id = away_team_id
             ) AS away_team,
             away_team_points,
             (      
                SELECT t.stadium_name
                FROM p12_team t 
                WHERE t.team_id = home_team_id
             ) AS stadium,
             (      
                SELECT t.capacity
                FROM p12_team t 
                WHERE t.team_id = home_team_id
             ) AS capacity,
             attendance

          FROM
          (
             SELECT 
                g.game_id AS gid,
                g.game_date as game_date,
                g.game_week as game_week,
                g.attendance as attendance,
                tg.home_team_id AS home_team_id,
                tg.home_team_points AS home_team_points,
                tg.away_team_id AS away_team_id,
                tg.away_team_points AS away_team_points
             FROM p12_game g
             INNER JOIN p12_team_performance tg ON tg.game_id = g.game_id
          ) AS tbl1
          WHERE game_week = ?
          ORDER BY gid
          "))) {

             echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!($stmt->bind_param("s",$_POST['Week']))){
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }

          if(!$stmt->execute()){
             echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          if(!($stmt->bind_result(
             $game_id,
             $game_date,
             $game_week,
             $home_team, 
             $home_team_points, 
             $away_team,
             $away_team_points,
             $stadium, 
             $capacity, 
             $attendance
          ))){
             echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }

          while($stmt->fetch()) {
             $sql_date = strtotime($game_date);
             $formatted_date = date("n/j", $sql_date);
             echo("<tr>\n
                    <td>" . $formatted_date . "</td>\n
                    <td>" . $game_week . "</td>\n
                    <td><a href=\"game.php?id=" . $game_id . "\">" . $away_team . "-" . $away_team_points . " @ " . $home_team . "-" . $home_team_points . "</a></td>\n
                    <td>" . $stadium . "</td>\n
                    <td>" . $capacity . "</td>\n
                    <td>" . $attendance . "</td>\n
                  </tr>\n");
          }
          $stmt->close();
          ?>
        </table>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>