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

            <form action = "process_team.php" method = "post">
               <fieldset>
                  <legend> Add Team</legend>
                  <input type="hidden" name="season" value="2015">
                  <p> School Name: <input type="text" name="institution" size="50" required placeholder="e.g. Oregon State University"></p>
                  <p> Team Name: <input type="text" name="team_name" size="30" required placeholder="e.g. Oregon State"></p>
                  <p> Team Abbreviation: <input type="text" name="team_short_name" size="10" required placeholder="e.g. ORST"></p>
                  <p> Nickname: <input type="text" name="nickname" size="15" required placeholder="e.g. Beavers"></p>
                  <p> City: <input type="text" name="city" size="15" required></p>
                  <p> State: 
                     <select name="state">
                        <?php
                           foreach($states as $abbreviation => $name) {
                              echo "<option value='" . $abbreviation . "''>" . $name . "</option>";
                           }
                        ?>
                     </select>
                  </p>
                  <p> Stadium Name: <input type="text" name="stadium" size="20" required></p>
                  <p> Stadium Capacity: <input type="number" name="capacity" size="5" required min="0"></p>
                  <p> Pac-12 Division:
                      <select name="division">
                        <option value="North">North</option>
                        <option value="South">South</option>
                      </select>
                  </p>
                  <p> 2015 Record:
                      <input type="number" name="wins" size="1" required min="0" max="9"> Wins
                      <input type="number" name="losses" size="1" required min="0" max="9"> Losses
                  </p>
                  <p> 2015 Points: <input type="number" name="points" size="3" required min="0"></p>
                  <p><input type="submit" value = "Add Team"></p>
               </fieldset>
            </form>
            
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>