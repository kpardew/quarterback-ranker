DROP TABLE IF EXISTS `p12_player_performance`;
DROP TABLE IF EXISTS `p12_team_performance`;
DROP TABLE IF EXISTS `p12_player`;
DROP TABLE IF EXISTS `p12_season_results`;
DROP TABLE IF EXISTS `p12_player_year`;
DROP TABLE IF EXISTS `p12_team`;
DROP TABLE IF EXISTS `p12_game`;


-- Create a table called p12_game with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_game (
   game_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   game_week INTEGER UNSIGNED NOT NULL,
   game_date DATETIME NOT NULL,
   attendance INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (game_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_team with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_team (
   team_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   institution VARCHAR(60) NOT NULL,
   team_name VARCHAR(30) NOT NULL,
   team_short_name VARCHAR(4) NOT NULL,
   nickname VARCHAR(30) NOT NULL,
   city VARCHAR(30) NOT NULL,
   state VARCHAR(2) NOT NULL,
   stadium_name VARCHAR(30) NOT NULL,
   capacity INTEGER UNSIGNED NOT NULL,
   division VARCHAR(10) NOT NULL,
   PRIMARY KEY (team_id),
   UNIQUE KEY (team_name)
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_player_year with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_player_year (
   year_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   year VARCHAR(20) NOT NULL,
   PRIMARY KEY (year_id)
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_season_results with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_season_results (
   id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   team_id INTEGER UNSIGNED NOT NULL,
   season INTEGER UNSIGNED NOT NULL,
   wins INTEGER UNSIGNED NOT NULL,
   losses INTEGER UNSIGNED NOT NULL,
   points INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (id),
   CONSTRAINT `fk_team_season` FOREIGN KEY (team_id) REFERENCES p12_team (team_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_player with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_player (
   player_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   team_id INTEGER UNSIGNED NOT NULL,
   first_name VARCHAR(20) NOT NULL,
   last_name VARCHAR(20) NOT NULL,
   uniform_number INTEGER NOT NULL,
   position VARCHAR(3) NOT NULL,
   eligibility_year INTEGER UNSIGNED,
   home_city VARCHAR(30) NOT NULL,
   home_state VARCHAR(2) NOT NULL,
   height INTEGER UNSIGNED NOT NULL,
   weight INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (player_id),
   CONSTRAINT `fk_player_team` FOREIGN KEY (team_id) REFERENCES p12_team (team_id) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_player_year` FOREIGN KEY (eligibility_year) REFERENCES p12_player_year (year_id) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_player_performance with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_player_performance (
   performance_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   game_id INTEGER UNSIGNED NOT NULL,
   player_id INTEGER UNSIGNED NOT NULL,
   passing_attempts INTEGER UNSIGNED NOT NULL,
   passing_completions INTEGER UNSIGNED NOT NULL,
   passing_yards INTEGER NOT NULL,
   passing_touchdowns INTEGER UNSIGNED NOT NULL,
   interceptions INTEGER UNSIGNED NOT NULL,
   rushing_attempts INTEGER UNSIGNED NOT NULL,
   rushing_yards INTEGER NOT NULL,
   rushing_touchdowns INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (performance_id),
   CONSTRAINT `fk_player_performance` FOREIGN KEY (player_id) REFERENCES p12_player (player_id) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_game_performance` FOREIGN KEY (game_id) REFERENCES p12_game (game_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create a table called p12_team_game with the following properties:
-- id - an auto incrementing integer which is the primary key
CREATE TABLE p12_team_performance (
   game_id INTEGER UNSIGNED NOT NULL,
   home_team_id INTEGER UNSIGNED NOT NULL,
   away_team_id INTEGER UNSIGNED NOT NULL,
   home_team_points INTEGER UNSIGNED NOT NULL,
   away_team_points INTEGER UNSIGNED NOT NULL,
   home_team_yards INTEGER UNSIGNED NOT NULL,
   away_team_yards INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (game_id, home_team_id, away_team_id),
   CONSTRAINT `fk_game` FOREIGN KEY (game_id) REFERENCES p12_game (game_id) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_home_team` FOREIGN KEY (home_team_id) REFERENCES p12_team (team_id) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_away_team` FOREIGN KEY (away_team_id) REFERENCES p12_team (team_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;