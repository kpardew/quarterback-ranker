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

        <?php
        // insert form data into player table
          $height = $_POST['feet'] * 12;
          $height = $height + $_POST['inches'];
          $position = "QB";

          if(!($stmt = $mysqli->prepare("
             INSERT INTO p12_player(
                team_id, 
                first_name, 
                last_name, 
                uniform_number,
                position,
                eligibility_year,
                home_city,
                home_state,
                height,
                weight) 
             VALUES (?,?,?,?,?,?,?,?,?,?)")))
          {
             echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("issisissii",
             $_POST['team'],
             $_POST['fname'],
             $_POST['lname'],
             $_POST['number'],
             $position,
             $_POST['year'],
             $_POST['city'],
             $_POST['state'],
             $height,
             $_POST['weight'])))
          {
             echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
             echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
          } else {
             echo ("<h3>Added " . $_POST['fname'] . " " . $_POST['lname'] . " successfully!</h3>");
             echo ("<p><a href=\"players.php\">View all players</p>");
          }
          $stmt->close();
        ?>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>