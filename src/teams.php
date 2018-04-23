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

         <div>
            <form method="post" action="filter_teams_division.php">
               <fieldset>
                  <legend>Filter By Division</legend>
                     <select name="Division">
                        <?php
                        // display division in option tag
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              division 
                           FROM p12_team
                           GROUP BY division
                           ORDER BY division
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $division
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo '<option value="'. $division . '"> ' . $division . '</option>\n';
                        }
                        $stmt->close();
                        ?>
                     </select>
                     <input type="submit" value="Run Filter" />
               </fieldset>
            </form>
         </div>
         <br>

         <div>
            <form method="post" action="filter_teams_state.php">
               <fieldset>
                  <legend>Filter By State</legend>
                     <select name="State">
                        <?php
                        // display state in option tag
                        if(!($stmt = $mysqli->prepare("
                           SELECT 
                              state 
                           FROM p12_team
                           GROUP BY state
                           ORDER BY state
                        "))){
                           echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result(
                           $state
                        )){
                           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                         echo '<option value="'. $state . '"> ' . $state . '</option>\n';
                        }
                        $stmt->close();
                        ?>
                     </select>
                     <input type="submit" value="Run Filter" />
               </fieldset>
            </form>
         </div>
         <br>
        <table>
         <tr>
            <th>TEAM</th>
            <th>NICKNAME</th>
            <th>DIVISION</th>
            <th>SCHOOL</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>STADIUM</th>
            <th>CAPACITY</th>
         </tr>

         <?php
         // display team information
         if(!($stmt = $mysqli->prepare("
            SELECT
               t.team_id,
               t.team_name,
               t.nickname,
               t.division,
               t.institution,
               t.city,
               t.state,
               t.stadium_name,
               t.capacity
            FROM p12_team t
            ORDER BY t.team_name
         "))) {

            echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!$stmt->execute()){
            echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         if(!($stmt->bind_result(
            $tid,
            $team,
            $nickname,
            $division,
            $institution,
            $city,
            $state,
            $stadium,
            $capacity
         ))){
            echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }

         while($stmt->fetch()) {
            echo("<tr>\n
                  <td><a href=\"team.php?id=" . $tid . "\">" . $team . "</a></td>\n
                  <td>" . $nickname . "</td>\n
                  <td>" . $division . "</td>\n
                  <td>" . $institution . "</td>\n
                  <td>" . $city . "</td>\n
                  <td>" . $state . "</td>\n
                  <td>" . $stadium . "</td>\n
                  <td>" . $capacity . "</td>\n
               </tr>\n");
         }
         $stmt->close();
         ?>
            </table>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>