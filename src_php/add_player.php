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

            <form action = "process_player.php" method = "post">
               <fieldset>
                  <legend> Add New Player </legend>
                  <p> First Name: <input type ="text" name="fname" required></p>
                  <p> Last Name: <input type ="text" name="lname" required></p>
                  <p> Team:
                     <select name="team">                        
                        <?php
                        // display team name in option tag
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
                         echo "<option value='". $team_id . "'>" . $team_name . "</option>\n";
                        }
                        $stmt->close();
                        ?>
                     </select>
                  <p> Uniform #: 
                     <select name="number">
                        <?php
                           for($i = 1; $i < 100; $i++) {
                              echo "<option value='" . $i . "''>" . $i . "</option>";
                           }
                        ?>
                     </select>
                  </p>
                  <p> Year: 
                     <select name="year">
                        <?php
                        // display player year in option tag
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
                         echo "<option value='". $year_id . "'>" . $year . "</option>\n";
                        }
                        $stmt->close();
                        ?>
                     </select>
                  </p>
                  <p> Home Town: <input type= "text" name="city" required placeholder="City">
                     <select name="state">
                        <?php
                           foreach($states as $abbreviation => $name) {
                              echo "<option value='" . $abbreviation . "''>" . $name . "</option>";
                           }
                        ?>
                     </select>
                  </p>
                  <p> Height:
                     <select name="feet">
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                     </select> feet
                     <select name="inches">
                        <?php
                           for($i = 0; $i < 12; $i++) {
                              echo "<option value='" . $i . "''>" . $i . "</option>";
                           }
                        ?>
                     </select> inches
                  <p> Weight: <input type ="number" size="3" name="weight" required min="0"> lbs</p>
                  <p><input type="submit" value = "Add Player"></p>
               </fieldset>
            </form>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>