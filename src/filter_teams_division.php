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
         
         <p><a href="teams.php">View all Teams</a></p>

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
           WHERE t.division = ?
           ORDER BY t.team_name
        "))) {

           echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }

        if(!($stmt->bind_param("s",$_POST['Division']))){
           echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
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