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

//0 to drop database, 1 to just clean all tables
$DROP_OR_CLEAN = 0;

$drop = "DROP DATABASE `moodle_db`";
$dbtables = [];
$dbtables[0] = "DELETE FROM `course` WHERE 1";
$dbtables[1] = "DELETE FROM `courses_taken` WHERE 1";
$dbtables[2] = "DELETE FROM `courses_taking` WHERE 1";
$dbtables[3] = "DELETE FROM `courses_teaching` WHERE 1";
$dbtables[4] = "DELETE FROM `course_replacements` WHERE 1";
$dbtables[5] = "DELETE FROM `course_requirements` WHERE 1";
$dbtables[6] = "DELETE FROM `major` WHERE 1";
$dbtables[7] = "DELETE FROM `major_map` WHERE 1";
$dbtables[8] = "DELETE FROM `major_map_coontents` WHERE 1";
$dbtables[9] = "DELETE FROM `student` WHERE 1";
$dbtables[10] = "DELETE FROM `user` WHERE 1";
$dbtables[11] = "DELETE FROM `user_authorization` WHERE 1";
$dbtables[11] = "DELETE FROM `user_credentials` WHERE 1";


if ($DROP_OR_CLEAN == 0) {
    if ($db->query($drop))
    {
        echo "\n\n".$drop." Database Droped";
        die;
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Database could not be dropped: ".$db->error."\n";
        die;
    }
}

//for loop to run each query in the array $dbtables
foreach ($dbtables as $query) {
    // success message if query runs correctly
    if ($db->query($query))
    {
        echo "\n\n".$query." Tables truncated";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be truncated: ".$db->error."\n";
        die;
    }
}
echo "\n";
//closes the database connection
$db->close();