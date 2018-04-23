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

            <form action = "add_player_performance2.php" method = "post">
               <fieldset>
                  <legend> Add Player Performance - Step 1</legend>
                  <p> Player Name:
                     <select name="player">                        
                        <?php
                        // display player name in option tag
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              player_id, 
                              first_name,
                              last_name
                           FROM p12_player
                           ORDER BY 
                              first_name,
                              last_name
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $player_id, 
                           $fname,
                           $lname
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo "<option value='". $player_id . "'>" . $fname . " " . $lname .  "</p>\n";
                        }
                        $stmt->close();
                        ?>
                     </select>
                  <p><input type="submit" value = "Choose Player"></p>
               </fieldset>
            </form>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>