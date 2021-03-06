-- Insert team information into p12_team
INSERT INTO p12_team (
   institution, 
   team_name,
   team_short_name,
   nickname,
   city,
   state,
   stadium_name,
   capacity,
   division
) 
VALUES 
   ('University of Arizona','Arizona','ARIZ','Wildcats','Tuscon','AZ','Arizona Stadium',57000,'South'),
   ('Arizona State University','Arizona State','ASU','Sun Devils','Tempe','AZ','Sun Devil Stadium',71706,'South'),
   ('University of California, Berkeley','California','CAL','Golden Bears','Berkeley','CA','Memorial Stadium',63000,'North'),
   ('University of Colorado Boulder','Colorado','COLO','Buffaloes','Boulder','CO','Folsom Field',53613,'South'),
   ('University of Oregon','Oregon','ORE','Ducks','Eugene','OR','Autzen Stadium',54000,'North'),
   ('Oregon State University','Oregon State','ORST','Beavers','Corvallis','OR','Reser Stadium',45674,'North'),
   ('Stanford University','Stanford','STAN','Cardinal','Stanford','CA','Stanford Stadium',50000,'North'),
   ('University of California, Los Angeles','UCLA','UCLA','Bruins','Los Angeles','CA','Rose Bowl',91500,'South'),
   ('University of Southern California','USC','USC','Trojans','Los Angeles','CA','Los Angeles Memorial Coliseum',93607,'South'),
   ('The University of Utah','Utah','UTAH','Utes','Salt Lake City','UT','Rice-Eccles Stadium',45017,'South'),
   ('University of Washington','Washington','WASH','Huskies','Seattle','WA','Husky Stadium',72500,'North'),
   ('Washington State University','Washington State','WSU','Cougars','Pullman','WA','Martin Stadium',35117,'North')
;


-- Insert team information into p12_season_results
INSERT INTO p12_season_results (
   team_id, 
   season,
   wins,
   losses,
   points
) 
VALUES 
   (1,2015,3,6,278),
   (2,2015,4,5,322),
   (3,2015,4,5,285),
   (4,2015,1,8,177),
   (5,2015,7,2,368),
   (6,2015,0,9,160),
   (7,2015,8,1,368),
   (8,2015,5,4,295),
   (9,2015,6,3,287),
   (10,2015,6,3,270),
   (11,2015,4,5,261),
   (12,2015,6,3,304)
;


-- Insert player year information into p12_player_year
INSERT INTO p12_player_year (
   year
)
VALUES 
   ("Freshman"),
   ("Sophomore"),
   ("Junior"),
   ("Senior")
;


-- Insert player information into p12_player
INSERT INTO p12_player (
   team_id,
   first_name,
   last_name,
   uniform_number,
   position,
   eligibility_year,
   home_city,
   home_state,
   height,
   weight
) 
VALUES 
   (12,'Luke','Falk',4,'QB',2,'Logan','UT',76,205),
   (3,'Jared','Goff',16,'QB',3,'Novato','CA',76,215),
   (8,'Josh','Rosen',3,'QB',1,'Mahattan Beach','CA',76,210),
   (9,'Cody','Kessler',6,'QB',4,'Bakersfield','CA',73,215),
   (2,'Mike','Bercovici',2,'QB',4,'Calabasas','CA',74,210),
   (4,'Sefo','Liufau',13,'QB',3,'Tacoma','WA',76,235),
   (1,'Anu','Solomon',12,'QB',2,'Las Vegas','NV',74,205),
   (11,'Jake','Browning',3,'QB',1,'Granite Bay','CA',74,206),
   (7,'Kevin','Hogan',8,'QB',4,'Mclean','VA',76,218),
   (10,'Travis','Wilson',7,'QB',4,'San Clemente','CA',79,233),
   (5,'Vernon','Adams Jr.',3,'QB',4,'Pasadena','CA',72,200),
   (6,'Seth','Collins',4,'QB',1,'San Diego','CA',75,195),
   (5,'Jeff','Lockie',17,'QB',3,'Alamo','CA',74,205),
   (1,'Jerrard','Randall',8,'QB',4,'Hollywood','FL',73,185),
   (6,'Nick','Mitchell',14,'QB',1,'North Bend','WA',75,198),
   (4,'Cade','Apsay',15,'QB',1,'Canyon Country','CA',73,190),
   (12,'Peyton','Bender',6,'QB',1,'Fort Lauderdale','FL',72,187),
   (6,'Marcus','McMaryion',3,'QB',1,'Dinuba','CA',73,200)
;


-- Insert game information into p12_game
INSERT INTO p12_game (
   game_week,
   game_date,
   attendance
) 
VALUES 
   (3,'2015-09-19 17:00:00',78306),
   (4,'2015-09-25 19:00:00',37302),
   (4,'2015-09-26 14:00:00',61066),
   (4,'2015-09-26 17:00:00',56004),
   (4,'2015-09-26 17:30:00',57145),
   (4,'2015-09-26 19:30:00',61904),
   (5,'2015-10-03 13:00:00',42043),
   (5,'2015-10-03 16:30:00',80113),
   (5,'2015-10-03 19:00:00',46222),
   (5,'2015-10-03 19:30:00',46628),
   (6,'2015-10-08 18:00:00',63623),
   (6,'2015-10-10 13:00:00',52987),
   (6,'2015-10-10 15:00:00',57775),
   (6,'2015-10-10 19:00:00',47798),
   (6,'2015-10-10 19:00:00',44157),
   (7,'2015-10-15 19:30:00',50464),
   (7,'2015-10-17 13:00:00',32952),
   (7,'2015-10-17 18:00:00',39666),
   (7,'2015-10-17 19:00:00',46192),
   (7,'2015-10-17 19:30:00',69285),
   (8,'2015-10-22 18:00:00',57046),
   (8,'2015-10-24 13:00:00',47874),
   (8,'2015-10-24 16:30:00',73435),
   (8,'2015-10-24 19:30:00',50424),
   (8,'2015-10-24 19:30:00',36977),
   (9,'2015-10-29 19:30:00',56534),
   (9,'2015-10-31 12:00:00',51508),
   (9,'2015-10-31 12:00:00',52060),
   (9,'2015-10-31 16:00:00',45853),
   (9,'2015-10-31 19:30:00',30012),
   (9,'2015-10-31 20:00:00',56749),
   (10,'2015-11-07 10:00:00',40142),
   (10,'2015-11-07 12:30:00',32952),
   (10,'2015-11-07 13:30:00',38074),
   (10,'2015-11-07 16:30:00',61420),
   (10,'2015-11-07 19:30:00',76309),
   (10,'2015-11-07 19:30:00',56604),
   (11,'2015-11-13 18:00:00',37905),
   (11,'2015-11-14 12:00:00',51693),
   (11,'2015-11-14 16:30:00',48633),
   (11,'2015-11-14 19:00:00',48912),
   (11,'2015-11-14 19:30:00',41874),
   (11,'2015-11-14 19:45:00',76255),
   (12,'2015-11-21 12:30:00',46230),
   (12,'2015-11-21 12:30:00',64885),
   (12,'2015-11-21 12:30:00',59094),
   (12,'2015-11-21 15:00:00',34390),
   (12,'2015-11-21 19:30:00',51424),
   (12,'2015-11-21 19:45:00',25121),
   (13,'2015-11-27 12:30:00',70438),
   (13,'2015-11-27 13:00:00',57814),
   (13,'2015-11-28 11:30:00',45823),
   (13,'2015-11-28 12:30:00',83602),
   (13,'2015-11-28 19:00:00',45385)
;


-- Insert game and team information into p12_team_game
INSERT INTO p12_team_performance (
   game_id,
   home_team_id,
   away_team_id,
   home_team_points,
   away_team_points,
   home_team_yards,
   away_team_yards
) 
VALUES 
   (1,9,7,31,41,427,474),
   (2,6,7,24,42,386,488),
   (3,11,3,24,30,256,481),
   (4,1,8,30,56,468,497),
   (5,5,10,20,62,400,530),
   (6,2,9,14,42,454,455),
   (7,3,12,34,28,469,403),
   (8,8,2,23,38,342,465),
   (9,4,5,24,41,308,537),
   (10,7,1,55,17,570,314),
   (11,9,11,12,17,346,299),
   (12,1,6,44,7,644,249),
   (13,5,12,38,45,533,641),
   (14,10,3,30,24,435,467),
   (15,2,4,48,23,491,450),
   (16,7,8,56,35,442,506),
   (17,12,6,52,31,520,394),
   (18,4,1,31,38,467,616),
   (19,10,2,34,18,369,257),
   (20,11,5,20,26,385,442),
   (21,8,3,40,24,573,426),
   (22,1,12,42,45,483,631),
   (23,9,10,42,24,380,353),
   (24,7,11,31,14,478,231),
   (25,6,4,13,17,401,328),
   (26,2,5,55,61,742,499),
   (27,8,4,35,31,400,554),
   (28,3,9,21,27,389,405),
   (29,10,6,27,12,372,312),
   (30,12,7,28,30,442,312),
   (31,11,1,49,3,468,330),
   (32,4,7,10,42,231,472),
   (33,12,2,38,24,512,458),
   (34,6,8,0,41,246,674),
   (35,11,10,23,34,381,346),
   (36,9,1,38,30,472,412),
   (37,5,3,44,28,777,432),
   (38,4,9,24,27,281,333),
   (39,2,11,27,17,397,547),
   (40,7,5,36,38,506,436),
   (41,1,10,37,30,460,442),
   (42,3,6,54,24,760,398),
   (43,8,12,27,31,554,426),
   (44,10,8,9,17,307,325),
   (45,2,1,52,37,565,449),
   (46,5,9,48,28,578,424),
   (47,6,11,7,52,257,482),
   (48,7,3,35,22,356,495),
   (49,12,4,27,3,481,323),
   (50,11,12,45,10,443,319),
   (51,5,6,52,42,674,427),
   (52,10,4,20,14,324,307),
   (53,9,8,40,21,410,367),
   (54,3,2,48,46,680,586)
;


-- Insert player performance information into p12_player_performance
INSERT INTO p12_player_performance (
   game_id,
   player_id,
   passing_attempts,
   passing_completions,
   passing_yards,
   passing_touchdowns,
   interceptions,
   rushing_attempts,
   rushing_yards,
   rushing_touchdowns
) 
VALUES 
   (1,9,23,18,279,2,0,7,28,0),
   (1,4,32,25,272,3,0,2,11,0),
   (2,9,14,9,163,2,1,1,2,0),
   (2,12,36,20,275,1,0,13,12,0),
   (3,2,40,24,342,2,1,9,-8,0),
   (3,8,28,17,152,0,2,9,-13,0),
   (4,3,28,19,284,2,0,4,7,1),
   (4,7,10,4,55,1,0,7,47,0),
   (4,14,16,4,45,1,1,16,128,1),
   (5,10,30,18,227,4,0,6,100,1),
   (5,13,20,10,139,1,2,10,37,0),
   (5,11,7,2,26,1,0,6,5,0),
   (6,4,33,19,375,5,1,3,6,0),
   (6,5,44,23,272,0,1,7,-20,0),
   (7,1,49,35,389,2,1,13,-25,1),
   (7,2,45,33,390,4,1,5,-32,0),
   (8,5,44,27,273,2,1,9,37,1),
   (8,3,40,22,280,2,1,2,-17,0),
   (9,13,11,8,54,0,1,5,18,0),
   (9,6,42,25,231,1,1,13,2,1),
   (10,14,28,15,178,1,0,9,67,0),
   (10,9,19,17,217,2,0,2,1,0),
   (11,8,32,16,137,0,1,2,-8,0),
   (11,4,29,16,156,0,2,5,-25,0),
   (12,12,24,8,56,0,1,10,56,1),
   (12,7,30,17,276,0,0,1,-3,0),
   (12,18,10,4,42,0,0,1,-8,0),
   (13,1,74,50,505,5,0,11,-49,1),
   (13,13,22,13,123,2,1,8,52,0),
   (14,2,47,25,340,2,5,9,30,0),
   (14,10,26,16,170,1,2,12,49,0),
   (15,6,40,25,389,1,1,10,-34,0),
   (15,5,31,20,260,5,1,7,40,0),
   (16,3,42,22,326,3,2,4,-17,0),
   (16,9,15,8,131,3,1,1,3,0),
   (17,12,30,17,176,1,2,23,124,1),
   (17,1,50,39,407,6,2,3,-19,0),
   (17,17,2,1,2,0,0,0,0,0),
   (18,7,37,22,283,2,0,6,-6,0),
   (18,14,3,3,42,0,0,11,81,1),
   (18,6,43,28,339,2,0,10,13,2),
   (19,5,41,20,242,0,1,8,-37,0),
   (19,10,36,26,297,2,0,10,-46,0),
   (20,11,25,14,272,2,0,8,12,0),
   (20,8,30,19,199,1,0,6,-5,0),
   (21,2,53,32,295,3,0,10,9,0),
   (21,3,47,34,399,3,0,3,8,0),
   (22,1,62,47,514,5,0,9,16,0),
   (22,7,20,12,145,0,0,3,24,0),
   (22,14,16,11,137,2,0,10,105,0),
   (23,10,36,24,254,2,4,13,35,0),
   (23,4,28,21,264,1,0,5,-25,1),
   (24,9,24,17,290,2,1,8,37,0),
   (25,6,24,17,157,1,0,18,44,1),
   (25,15,24,9,122,0,1,4,-18,0),
   (25,12,7,4,77,0,0,9,50,0),
   (26,11,40,23,315,4,1,8,-15,0),
   (26,5,53,32,398,5,2,16,58,1),
   (27,6,57,37,312,0,2,15,45,0),
   (27,3,33,19,262,1,0,1,-15,0),
   (28,4,22,18,186,0,0,5,9,0),
   (28,2,31,23,272,2,2,4,23,0),
   (29,15,35,19,204,1,0,12,40,0),
   (29,10,17,14,198,1,0,14,56,1),
   (30,9,19,10,86,0,1,14,112,2),
   (30,1,61,35,354,2,2,5,-7,0),
   (31,7,31,18,160,0,2,8,-3,0),
   (31,14,11,7,43,0,1,11,46,0),
   (31,8,24,16,263,4,0,5,7,1),
   (32,9,23,17,169,2,1,9,40,1),
   (32,6,18,10,125,0,1,7,43,0),
   (32,16,5,3,23,0,1,4,-7,0),
   (33,5,44,27,229,0,1,8,-2,1),
   (33,1,55,36,497,5,1,5,-24,0),
   (34,3,33,22,333,2,0,4,5,0),
   (34,15,19,9,84,0,3,9,-3,0),
   (34,18,5,1,47,0,0,0,0,0),
   (35,10,25,12,155,0,1,10,42,2),
   (35,8,39,23,257,1,1,9,12,0),
   (36,7,46,31,352,3,1,11,-2,0),
   (36,4,36,22,243,2,0,4,-31,0),
   (37,2,41,18,329,2,1,2,-17,0),
   (37,11,29,17,300,4,2,8,43,1),
   (38,4,27,17,204,3,1,2,-14,0),
   (38,6,8,6,94,0,0,2,4,0),
   (38,16,23,18,128,2,0,8,-36,0),
   (39,8,52,28,405,1,3,10,7,0),
   (39,5,34,22,253,1,0,9,-10,0),
   (40,11,10,12,205,2,0,8,-11,0),
   (40,9,37,28,304,2,1,11,48,1),
   (41,10,31,20,219,2,1,13,31,0),
   (41,7,27,17,277,2,1,10,86,1),
   (41,14,5,1,25,1,1,4,-3,0),
   (42,15,28,14,161,2,0,8,49,1),
   (42,2,37,26,453,6,1,3,-13,0),
   (42,18,8,1,33,0,0,1,3,0),
   (43,1,53,38,331,2,1,10,-17,0),
   (43,3,57,33,340,0,0,5,70,1),
   (43,17,5,2,57,1,0,0,0,0),
   (44,3,30,15,220,1,0,4,-7,0),
   (44,10,26,13,110,0,0,18,67,0),
   (45,14,13,4,35,0,0,4,22,0),
   (45,5,32,21,315,2,1,7,3,1),
   (46,4,41,30,238,2,0,7,-18,0),
   (46,11,25,20,407,6,1,4,-11,0),
   (47,8,20,18,211,4,0,3,7,0),
   (47,18,16,8,109,1,1,4,21,0),
   (47,15,7,0,0,0,0,2,10,0),
   (48,2,54,37,386,2,0,4,-8,0),
   (48,9,12,7,96,1,0,2,2,0),
   (49,16,40,26,238,0,2,9,8,0),
   (49,1,35,27,199,1,0,2,-4,0),
   (49,17,22,13,133,1,1,0,0,0),
   (50,17,58,36,288,1,2,3,-18,0),
   (50,8,20,14,203,0,1,6,6,0),
   (51,18,21,11,154,0,1,6,5,1),
   (51,12,4,2,45,0,0,9,39,3),
   (51,11,38,28,366,3,0,9,32,0),
   (52,16,18,8,145,1,2,6,0,0),
   (52,10,26,10,108,1,1,13,32,0),
   (53,3,37,19,227,1,2,5,-9,0),
   (53,4,26,15,175,2,0,5,-1,1),
   (54,5,43,27,395,4,0,9,0,0),
   (54,2,51,30,542,5,0,3,31,0)
;