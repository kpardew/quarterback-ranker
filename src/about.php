<?php include('header.php'); ?>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="games.php">Games</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Total Effectiveness Rating (TER)</h1>
        <p class="lead">In 2012, Johnny Manziel from Texas A&amp;M University won the Heisman Trophy with nearly 73% of the votes.
          <br>He went on to become the 22nd overall pick in the 2014 NFL draft by the Cleveland Browns.
          <br>However, he didn't even rank in the top 10 in the NCAA for quarterbacks,<br>using the conventional measurement of Passing Efficiency.
          <br>But through his performance and leadership, Texas A&amp;M finished the season 11-2,<br>ranked 5th in the nation, and defeated Oklahoma in the 2013 Cotton Bowl.
          <br>
          <br>This website ranks the 2015 Pac-12 quarterbacks by considering their<br>overall contributions to their team, as well as their passing and rushing statistics.
          <br>The raw TER calculation considers the quarterbacks statistics, as well as their share of their team's total points.
          <br>Their team's overall record is also taken into consideration in the adjusted TER calculation.
        </p>
        <h2>TER Calculations</h2>
        <p>Passing Efficiency: ((8.4 * Passing Yards) + (330 * Passing Touchdowns) - (200 * Interceptions) + (100 * Completions)) / Passing Attempts</p>
        <p>Rushing Efficiency: ((8.4 * Rushing Yards) + (330 * Rushing Touchdowns)) / Rushing Attempts</p>
        <p>Total Efficiency: ((Passing Efficiency * 4) + Rushing Efficiency) / 5</p>
        <p>Point %: Total Player Points / Total Team Points</p>
        <p>Win %: Team Wins / Games Played</p>
        <p>Raw TER: Total Efficiency * Point %</p>
        <p>Adjusted TER: Raw TER * Win %</p>
      </div>

    </div><!-- /.container -->
<?php include('footer.php'); ?>