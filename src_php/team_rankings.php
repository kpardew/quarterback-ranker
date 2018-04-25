<?php include('header.php'); ?>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="players.php">Players</a></li>
            <li class="active"><a href="teams.php">Teams</a></li>
            <li><a href="games.php">Games</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>2015 Pac-12 Confercence Standings</h1>
        <table>
         <tr>
            <th colspan="3">Pac-12 North</th>
         </tr>
         <tr>
            <th>TEAM</th>
            <th>RECORD</th>
            <th>POINTS</th>
         </tr>
<?php

if(!($stmt = $mysqli->prepare("
   SELECT
      t.team_id,
      t.team_short_name,
      sr.wins,
      sr.losses,
      sr.points
   FROM p12_team t
   INNER JOIN p12_season_results sr ON sr.team_id = t.team_id
   WHERE t.division = 'North'
   ORDER BY sr.wins DESC
"))) {

   echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->execute()){
   echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->bind_result(
   $tid,
   $team,
   $wins, 
   $losses, 
   $points
))){
   echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()) {
   echo("<tr>\n
         <td><a href=\"team.php?id=" . $tid . "\">" . $team . "</a></td>\n
         <td>" . $wins . "-" . $losses . "</td>\n
         <td>" . $points . "</td>\n
      </tr>\n");
}
$stmt->close();
?>
            </table>
            <br>
            <table>
               <tr>
                  <th colspan="3">Pac-12 South</th>
               </tr>
               <tr>
                  <th>TEAM</th>
                  <th>RECORD</th>
                  <th>POINTS</th>
               </tr>
<?php

if(!($stmt = $mysqli->prepare("
   SELECT
      t.team_id,
      t.team_short_name,
      sr.wins,
      sr.losses,
      sr.points
   FROM p12_team t
   INNER JOIN p12_season_results sr ON sr.team_id = t.team_id
   WHERE t.division = 'South'
   ORDER BY sr.wins DESC
"))) {

   echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->execute()){
   echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->bind_result(
   $tid,
   $team,
   $wins, 
   $losses, 
   $points
))){
   echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()) {
   echo("<tr>\n
         <td><a href=\"team.php?id=" . $tid . "\">" . $team . "</a></td>\n
         <td>" . $wins . "-" . $losses . "</td>\n
         <td>" . $points . "</td>\n
      </tr>\n");
}
$stmt->close();
?>
        </table>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>