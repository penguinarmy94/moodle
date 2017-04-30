<?php


//require_once ("src/views/view.php");
require_once ("src/views/AdminMapView.php");
//require_once("vendor/autoload.php");

require_once ("src/views/AdminMapView.php");
//require_once ("src/views/LoginView.php");
require_once ("src/controllers/navigationcontroller.php");

use moodle\views as VIEW;

$session_data =  [];
//'courses' -> an array fo course abbrev.
//'ids' -> an array of course id corresponding to abbrev
//'finished' -> ids that correspond to what courses the user has finished
//'map' -> matrix of the next courses they can take
//'role' -> user role (0= admin, 1= teacher, 2= student)
//'user_role' -> id of user
//'name' ->



if (!isset($_REQUEST['c'])) {
    $session_data['user_role'] = 1;
    $session_data['user_name'] = "Jorge Aguiniga";
    $session_data['user_id'] = "008214700";
    $a = new VIEW\AdminMapView($session_data);
    $a->render();
}
else if(isset($_POST['add']))
{
	/*
    $class = new VIEW\View();
    $method = "render";
    $class->$method();
    echo "<div>".$_POST['add']."</div>";
	*/
}
else if (isset($_REQUEST['c']) && isset($_REQUEST['m']))
{
	$class = $_REQUEST['c'];
	if($class == "NavigationController")
	{
		$class = 'moodle\\controllers\\'.$class;
		$class = new $class();
		$user['first'] = "Kevin";
		$user['last'] = "Dang";
		$user['major'] = "Software Engineering";
		$method = $_REQUEST['m'];			
		$class->$method($user);
	}
}
else
{
	$class = new VIEW\AdminMapView();
	$method = "render";
	$class->$method();
}