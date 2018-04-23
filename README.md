# quarterback-ranker
In 2012, Johnny Manziel from Texas A&M University won the Heisman Trophy with nearly 73% of the votes. He went on to become the 22nd overall pick in the 2014 NFL draft by the Cleveland Browns. However, he didn't even rank in the top 10 in the NCAA for quarterbacks, using the conventional measurement of Passing Efficiency. But through his performance and leadership, Texas A&M finished the season 11-2, ranked 5th in the nation, and defeated Oklahoma in the 2013 Cotton Bowl.

ESPN [identified](http://www.espn.com/college-football/story/_/id/9612585/total-quarterback-rating-college-football) this as an issue and developed their "Total quarterback rating" calculation. This is generally abbreviated as QBR and has become the convential measurement of collegate quarterback performance. I have devised a calculation that I’m calling Total Effectiveness Rating (TER) which takes a quarterback’s complete performance in a game into consideration. The raw TER calculation considers the quarterbacks statistics, as well as their share of their team's total points. Their team's overall record is also taken into consideration in the adjusted TER calculation. I am using a full-stack PHP web application to interface with the database and display the TER ratings. The entire TER calculation is performed in SQL and the results are then displayed in the application. This application also shows demographic information on each player, pertinent information on the teams in the Pac-12, information on games in the 2015 season, and final team rankings for the 2015 season.

Using the [provided](/sql/table_insertions.sql) sql insertion statements, a MySQL database can be pre-populated with the results from the first 13 weeks of the 2015 season. The user has the ability to add new quarterbacks, assign them to teams, and enter their performances in the games they played in during the season. The user can also create a new team and enter that team’s performance for the 2015 season. Finally the user can enter in the final results of the 2015 Pac-12 championship game, which was played on December 5th.

## TER Calculation
* Passing Efficiency: ((8.4 * Passing Yards) + (330 * Passing Touchdowns) - (200 * Interceptions) + (100 * Completions)) / Passing Attempts
* Rushing Efficiency: ((8.4 * Rushing Yards) + (330 * Rushing Touchdowns)) / Rushing Attempts
* Total Efficiency: ((Passing Efficiency * 4) + Rushing Efficiency) / 5
* Point %: Total Player Points / Total Team Points
* Win %: Team Wins / Games Played
* Raw TER: Total Efficiency * Point %
* Adjusted TER: Raw TER * Win %

## ER Diagram
![ER Diagram](/images/er.png)

## Database Schema
![Database Schema](/images/schema.png)

## Database Initialization
The [provided](/sql/table_definitions.sql) sql script will build database schema shown above. 

## Potential Extensions
This application is currently limited to the Pac-12, but could be easily extended to include all 129 NCAA FBS teams. The schema would need be altered to include a conferences table, but that is a trivial extension. The application is written in PHP. Why not try to convert it to Node, Rails, Django, .NET MVC, or whatever other backend you're comfortable with. And, of course, the front end is very basic Bootstrap. The sky is the limit with potential renovations of the UI. I wrote this in the fall of 2015 and have moved on to other things, but I hope someone else sees this as a solid template for a fun full-stack application. 
