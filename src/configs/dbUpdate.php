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

$db->select_db(Config::db);

//initializing query array
$dbtables = [];

//courses_teaching (teacher id (user_id), courses they are teaching (course_id))
$dbtables[0] = "CREATE TABLE `courses_teaching` (`user_id` INT UNSIGNED NOT NULL, `course_id` INT UNSIGNED NOT NULL);";

//courses_taking (course id, prerequisite_course)
$dbtables[1] = "CREATE TABLE `courses_taking` (`user_id` INT UNSIGNED NOT NULL, `course_id` INT UNSIGNED NOT NULL);";

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