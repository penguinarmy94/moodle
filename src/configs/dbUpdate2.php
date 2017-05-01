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

function insert_course($name, $abbrev, $db) {
    $Q = "INSERT INTO `course`(`course_name`, `course_abbrev`) VALUES ('".$name."', '".$abbrev."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_courses_taken($userID, $courseID, $db) {
    $Q = "INSERT INTO `courses_taken`(`user_id`, `course_id`) VALUES ('".$userID."', '".$courseID."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_course_replacements ($id1, $id2, $db) {
    $Q = "INSERT INTO `course_replacements`(`id1`, `id2`) VALUES ('".$id1."', '".$id2."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_courses_requirements($course, $prereq, $db) {
    $Q = "INSERT INTO `course_requirements`(`course_id`, `prerequisite`) VALUES ('".$course."', '".$prereq."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_major($name, $description, $db) {
    $Q = "INSERT INTO `major`(`major_name`, `major_description`) VALUES ('".$name."', '".$description."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_map($name, $major_id, $db) {
    $Q = "INSERT INTO `major_map`(`map_name`, `for_major_id`) VALUES ('".$name."', '".$major_id."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_map_contents($map, $course, $db) {
    $Q = "INSERT INTO `major_map_coontents`(`map_id`, `course_id`) VALUES ('".$map."', '".$course."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_student($userID, $majorID, $db) {
    $Q = "INSERT INTO `student`(`user_id`, `major_id`) VALUES ('".$userID."', '".$majorID."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_user($fName, $lName, $db) {
    $Q = "INSERT INTO `user`(`firstname`, `lastname`) VALUES ('".$fName."', '".$lName."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_user_auth($id, $role, $db) {
    $Q = "INSERT INTO `user_authorization`(`user_id`, `user_role`) VALUES ('".$id."', '".$role."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_user_cred($id, $email, $password, $db) {
    $Q = "INSERT INTO `user_credentials`(`user_id`, `user_email`, `user_password`) VALUES ('".$id."', '".$email."', '".$password."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_teaching($tID, $cID, $db) {
    $Q = "INSERT INTO `courses_teaching`(`user_id`, `course_id`) VALUES ('".$tID."', '".$cID."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}

function insert_courses_taking($uID, $cID, $db) {
    $Q = "INSERT INTO `courses_taking`(`user_id`, `course_id`) VALUES ('".$uID."', '".$cID."')";
    if ($db->query($Q))
    {
        echo "\n\n".$Q." created";
    }
    // gives error message if query did not run successfully and stops the script
    else
    {
        echo "Table could not be created: ".$db->error."\n";
        die;
    }
}


$courses = [["Calculus I", "MATH030"], ["Discrete Mathematics", "MATH042"], ["Introduction to Programming", "CS046A"], ["Calculus II", "MATH031"], ["General Physics/Mechanics", "PHYS050"], ["Introduction to Data Structures", "CS046B"], ["Linear Algebra I", "MATH129A"], ["Calculus III", "MATH032"], ["General Physics/Electricity and Magnetism", "PHYS051"], ["Data Structures and Algorithms", "CS146"], ["Object-Oriented Design", "CS151"], ["Computer Organization and Architecture", "CMPE120"], ["Assembly Language Programming", "CMPE102"], ["Software Engineering I", "CMPE131"], ["Ordinary Differential Equations", "MATH133A"], ["Introduction to Database Management Systems", "CS157A"], ["Operating Systems", "CS149"], ["Engineering Probability and Statistics", "ISE130"], ["Information Security", "CS166"], ["Engineering Reports", "ENGR100W"], ["Wireless Mobile Software Engineering", "CMPE137"], ["Software Quality Engineering", "CMPE187"], ["Software Engineering II", "CMPE133"], ["Database Management Systems II", "CS157B"], ["Enterprise Software Platforms", "CMPE172"], ["Computer Networks I", "CMPE148"], ["Senior Design Project I", "CMPE195A"], ["Senior Design Project II", "CMPE195B"], ["Software Engineering Process Management", "CMPE165"], ["Computer and Human Interaction", "ISE164"]];

$users = [["Jorge", "Aguiniga"], ["Luis", "Otero"], ["Andy", "Kwan"], ["Ricky", "Huang"], ["Angelo", "Dipino"], ["Manisha", "Yalavarthy"], ["Jay", "Bajaj"], ["Kevin", "Dang"], ["Yoho", "Chen"], ["Cristina", "Chen"], ["Sarah", "Sneed"], ["Nicole", "Beard"], ["Yukino", "Strong"], ["Krystal", "Mclaughlin"], ["Kane", "Mclaughlin"], ["Andrew", "Javier"], ["Jonathon", "Chen"], ["Isa", "Otero"], ["Magi", "Arrellano"], ["Misaka", "Mikoto"], ["Emilia", "Clarke"], ["Troy", "Nguyen"]];

insert_major("Software Engineering Fall 2012", "SE2012 catalogue", $db);

$id = 1;
foreach ($users as $user) {
    insert_user($user[0], $user[1], $db);
    $username = $user[0].".".$user[1];
    $password = "password";
    if ($user[0] == "Jorge") {
        $role = 0;
    }
    else if ($user[0] == "Andy" || $user[0] == "Jay" || $user[0] == "Misaka") {
        $role = 1;
    }
    else {
        $role = 2;
        insert_student($id, 1, $db);
    }
    insert_user_auth($id, $role, $db);
    insert_user_cred($id, $username, $password, $db);
    $id++;
}

$id = 1;
foreach ($courses as $course) {
    if (strpos($course[1], 'CS') !== false) {
        //Andy
        insert_course($course[0], $course[1], $db);
        insert_teaching(3, $id, $db);
    }
    else if (strpos($course[1], 'CMPE') !== false) {
        //Jay
        insert_course($course[0], $course[1], $db);
        insert_teaching(7, $id, $db);
    }
    else {
        insert_course($course[0], $course[1], $db);
        insert_teaching(20, $id, $db);
    }
    $id++;
}

for ($j=1; $j < 23; $j++) {
    echo $j;
   for ($i=1; $i < 14; $i++) {
        echo "  ";
        echo $i;
        echo "\n";
       if ($j === 1 || $j === 3 || $j === 7 || $j === 20) {
            echo "NADA for taken ".$j."\n";
       }
       else {
            echo "Attempt for taken ".$j."\n";
            insert_courses_taken($j, $i, $db);
       }
   }
}

for ($j=1; $j < 23; $j++) {
   for ($i=14; $i < 17; $i++) {
       if ($j === 1 || $j === 3 || $j === 7 || $j === 20) {
            echo "NADA for taking ".$j."\n";
       }
       else {
            echo "Attempt for taking ".$j."\n";
            insert_courses_taking($j, $i, $db);
       }
   }
}

insert_courses_requirements(4, 1, $db);
insert_courses_requirements(5, 1, $db);
insert_courses_requirements(6, 3, $db);
insert_courses_requirements(7, 4, $db);
insert_courses_requirements(8, 4, $db);
insert_courses_requirements(9, 5, $db);
insert_courses_requirements(10, 1, $db);
insert_courses_requirements(10, 2, $db);
insert_courses_requirements(10, 6, $db);
insert_courses_requirements(11, 2, $db);
insert_courses_requirements(11, 6, $db);
insert_courses_requirements(12, 6, $db);
insert_courses_requirements(13, 6, $db);
insert_courses_requirements(14, 6, $db);
insert_courses_requirements(15, 8, $db);
insert_courses_requirements(16, 10, $db);
insert_courses_requirements(17, 10, $db);
insert_courses_requirements(17, 12, $db);
insert_courses_requirements(18, 8, $db);
insert_courses_requirements(19, 10, $db);
insert_courses_requirements(19, 12, $db);
insert_courses_requirements(21, 14, $db);
insert_courses_requirements(22, 14, $db);
insert_courses_requirements(23, 14, $db);
insert_courses_requirements(24, 16, $db);
insert_courses_requirements(25, 16, $db);
insert_courses_requirements(25, 17, $db);
insert_courses_requirements(26, 18, $db);
insert_courses_requirements(26, 6, $db);
insert_courses_requirements(27, 18, $db);
insert_courses_requirements(27, 14, $db);
insert_courses_requirements(28, 27, $db);
insert_courses_requirements(29, 23, $db);

insert_map("Fall 2012 Map", 1, $db);

$id = 1;
foreach ($courses as $course) {
    insert_map_contents(1, $id, $db);
    $id++;
}



echo "\n";
//closes the database connection
$db->close();