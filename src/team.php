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

      <?php
      // display team information
      if(!($stmt = $mysqli->prepare("
         SELECT
            t.team_id,
            t.team_name,
            t.nickname,
            t.institution,
            t.city,
            t.state,
            t.stadium_name,
            t.capacity,
            t.division
         FROM p12_team t
         WHERE t.team_id = '" . $_GET["id"] . "'
         ORDER BY t.team_name
      "))) {

         echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      if(!$stmt->execute()){
         echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      if(!($stmt->bind_result(
         $team_id,
         $name,
         $nickname, 
         $institution, 
         $city, 
         $state, 
         $stadium, 
         $capacity,
         $division
      ))){
         echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
      }

      while($stmt->fetch()) {
         echo("
            <h1>" . $name . " " . $nickname . "<h1>\n
            <h2>Pac-12 " . $division . "<h2>\n
            <br>\n
            <h2>" . $institution . "<h2>\n
            <h2>" . $city . ", " . $state . "<h2>\n
            <br>\n
            <h3>" . $stadium . " | " . $capacity . " capacity<h3>\n
            ");
      }
      $stmt->close();
      ?>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>