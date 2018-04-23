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

      <?php
      // display game information
      if(!($stmt = $mysqli->prepare("
         SELECT
            gid,
            game_date,
            game_week,
            attendance,
            home_team_id,
            (      
               SELECT t.team_name
               FROM p12_team t 
               WHERE t.team_id = home_team_id
            ) AS home_team,
            (      
               SELECT t.nickname
               FROM p12_team t 
               WHERE t.team_id = home_team_id
            ) AS home_team_nickname,
            (      
               SELECT t.team_short_name
               FROM p12_team t 
               WHERE t.team_id = home_team_id
            ) AS home_team_short_name,
            away_team_id,
            (
               SELECT t.team_name
               FROM p12_team t 
               WHERE t.team_id = away_team_id
            ) AS away_team,
            (      
               SELECT t.nickname
               FROM p12_team t 
               WHERE t.team_id = away_team_id
            ) AS away_team_nickname,
            (      
               SELECT t.team_short_name
               FROM p12_team t 
               WHERE t.team_id = away_team_id
            ) AS away_team_short_name,
            home_team_points,
            away_team_points,
            home_team_yards,
            away_team_yards
         FROM
         (
            SELECT 
               g.game_id AS gid,
               g.game_date as game_date,
               g.game_week as game_week,
               g.attendance as attendance,
               tg.home_team_id AS home_team_id,
               tg.away_team_id AS away_team_id,
               tg.home_team_points as home_team_points,
               tg.away_team_points as away_team_points,
               tg.home_team_yards as home_team_yards,
               tg.away_team_yards as away_team_yards
            FROM p12_game g
            INNER JOIN p12_team_performance tg ON tg.game_id = g.game_id
         ) AS tbl1
         WHERE gid = '" . $_GET["id"] . "'
      "))) {

         echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      if(!$stmt->execute()){
         echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      if(!($stmt->bind_result(
         $gid,
         $game_date, 
         $game_week, 
         $attendance,
         $home_team_id,
         $home_team, 
         $home_team_nickname, 
         $home_team_short_name, 
         $away_team_id,
         $away_team,
         $away_team_nickname,
         $away_team_short_name,
         $home_team_points,
         $away_team_points,
         $home_team_yards,
         $away_team_yards
      ))){
         echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      while($stmt->fetch()) {
         $sql_date = strtotime($game_date);
         $formatted_date = date("l, F j, Y", $sql_date);
         $sql_time = strtotime($game_date);
         $formatted_time = date("g:i A", $sql_date);
         echo("
            <h1><a href=\"team.php?id=" . $away_team_id . "\">" . $away_team . " " . $away_team_nickname . "</a> @ <a href=\"team.php?id=" . $home_team_id . "\">" . $home_team . " " . $home_team_nickname . "</a><h1>\n
            <h2>" . $formatted_date . "<h2>\n
            <h2>" . $formatted_time . "<h2>\n
            <br>\n
            <h3>" . $away_team_short_name . " - " . $away_team_points .  " | " . $away_team_yards . " yards<h3>\n
            <h3>" . $home_team_short_name . " - " . $home_team_points .  " | " . $home_team_yards . " yards<h3>\n
            <br>\n
            <h3>Attendance: " . $attendance . "<h3>\n
            ");
      }
      $stmt->close();
      ?>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>