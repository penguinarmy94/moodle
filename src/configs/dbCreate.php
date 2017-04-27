<?php

namespace moodle\configs;

require_once('configs.php');
/**
  Script to create and initialize the database for Note-A-List
*/
$hostname = Config::host.":".Config::port;

//creates a mySQL connection
$db = new \mysqli($hostname, Config::user, Config::password);

//checks if the host cannot connect to the mySQL database and if so stops the script
if ($db->connect_error)
{
    die('Could not connect to the database: ');
}

echo "connection success\n";

$dbcreate = 'CREATE DATABASE IF NOT EXISTS '.Config::db;

//checks if creating the Note-A-List database was successful
if ($db->query($dbcreate) === true)
{
    echo Config::db." created\n";
    $db->select_db(Config::db);
}
//gives a error message if there was an error creating the database and stops the script
else
{
    echo "Database could not be created: ".$db->error."\n";
    die;
}

//initializing query array
$dbtables = [];

//course (course id, course name, course abbrev)
$dbtables[0] = "CREATE TABLE `course` (`course_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `course_name` VARCHAR(100) NOT NULL, `course_abbrev` VARCHAR(10) NOT NULL, PRIMARY KEY (`course_id`));";

//course_requirements (course id, prerequisite_course)
$dbtables[1] = "CREATE TABLE `course_requirements` (`course_id` INT UNSIGNED NOT NULL, `prerequisite` INT UNSIGNED NOT NULL);";

//course_replacements (course id1, course id2)
$dbtables[2] = "CREATE TABLE `course_replacements` (`id1` INT UNSIGNED NOT NULL, `id2` INT UNSIGNED NOT NULL);";

//user (user id, user firstname, user lastname)
$dbtables[3] = "CREATE TABLE `user` (`user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `firstname` VARCHAR(50) NOT NULL, `lastname` VARCHAR(50) NOT NULL, PRIMARY KEY (`user_id`));";

//user_credentials (user email, user password, user id)
$dbtables[4] = "CREATE TABLE `user_credentials` (`user_id` INT UNSIGNED NOT NULL, `user_email` VARCHAR(100) NOT NULL, `user_password` VARCHAR(100) NOT NULL);";

//user_authorization (user id, user role)
$dbtables[5] = "CREATE TABLE `user_authorization` (`user_id` INT UNSIGNED NOT NULL, `user_role` INT NOT NULL);";

//student (user id, user major, user major map)
$dbtables[6] = "CREATE TABLE `student` (`user_id` INT UNSIGNED NOT NULL, `major_id` INT UNSIGNED NOT NULL, `map_id` INT UNSIGNED NOT NULL);";

//courses_taken (user id, course id)
$dbtables[7] = "CREATE TABLE `courses_taken` (`user_id` INT UNSIGNED NOT NULL, `course_id` INT UNSIGNED NOT NULL);";

//major (major id, major name, major description)
$dbtables[8] = "CREATE TABLE `major` (`major_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `major_name` VARCHAR(100) NOT NULL, `major_description` VARCHAR(500) NOT NULL, PRIMARY KEY (`major_id`));";

//major_map (map id, map name, map for_major)
$dbtables[9] = "CREATE TABLE `major_map` (`map_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `map_name` VARCHAR(100) NOT NULL, for_major_id INT UNSIGNED NOT NULL, PRIMARY KEY (`map_id`));";

//major_map_coontents(map id, course_id)
$dbtables[10] = "CREATE TABLE `major_map_coontents` (`map_id` INT UNSIGNED NOT NULL, `course_id` INT UNSIGNED NOT NULL);";

//for loop to run each query in the array $dbtables
foreach ($dbtables as $query) {
    // success message if query runs correctly
    if ($db->query($query))
    {
        echo "\n\n".$query." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}
echo "\n";
//closes the database connection
$db->close();
