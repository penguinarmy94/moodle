<?php

namespace moodle\configs;

function welcome() {
    echo "\n Welcome to the database options place for all your moodle database needs! \n";

    echo " What action will you like to do:\n";
    echo "     'drop': drop database\n";
    echo "     'create': creates all the tables with no data\n";
    echo "     'fill': fills tables with data\n";
    echo "     'init': initiates a new database with all tables and data\n";
    echo "     'quit': exit\n";
    echo "\n action:   ";
}

$stay = true;
welcome();
while ($stay) {
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    fclose($handle);
    if(trim($line) == 'drop'){
        exec('php dbClean.php');
        echo "\n FINISHED \n";
        welcome();
    }
    else if (trim($line) == 'create') {
        exec('php dbCreate.php');
        exec('php dbUpdate.php');
        echo "\n FINISHED \n";
        welcome();
    }
    else if (trim($line) == 'fill') {
        exec('php dbUpdate2.php');
        echo "\n FINISHED \n";
        welcome();
    }
    else if (trim($line) == 'init') {
        exec('php dbCreate.php');
        exec('php dbUpdate.php');
        exec('php dbUpdate2.php');
        echo "\n FINISHED \n";
        welcome();
    }
    else if (trim($line) == 'quit') {
        $stay = false;
    }
    else {
        echo "\n please select supported action:   ";
    }
}

echo "\n\n Thank you for using initiate_database.php brought to you by Jorge&Co.\n";
exit;




