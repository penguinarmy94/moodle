<?php


//require_once ("src/views/view.php");
require_once ("src/views/AdminMapView.php");
require_once ("src/views/TeacherMapView.php");
require_once ("src/views/StudentMapView.php");
//require_once("vendor/autoload.php");
require_once ("src/views/EditMapCourseView.php");
require_once ("src/views/AdminMapView.php");
//require_once ("src/views/LoginView.php");
require_once ("src/controllers/navigationcontroller.php");
require_once ("src/controllers/formcontroller.php");

use moodle\views as VIEW;
use moodle\controllers as CTR;

$session_data =  [];

/*
//An administrator
$session_data['first'] = "Jorge";
$session_data['last'] = "Aguiniga";
$session_data['user_role'] = 0;
$session_data['major'] = "Software Engineering Fall 2012";
$session_data['user_name'] = "Jorge Aguiniga";
$session_data['user_id'] = 1;	
*/

/*
//A student 
$session_data['first'] = "Luis";
$session_data['last'] = "Otero";
$session_data['user_role'] = 2;
$session_data['major'] = "Software Engineering Fall 2012";
$session_data['user_name'] = "Luis Otero";
$session_data['user_id'] = 2;
*/


/*
//A teacher
$session_data['first'] = "Andy";
$session_data['last'] = "Kwan";
$session_data['user_role'] = 1;
$session_data['major'] = "Software Engineering Fall 2012";
$session_data['user_name'] = "Andy Kwan";
$session_data['user_id'] = 3;
*/

if(isset($_POST['map_name']) && isset($_POST['map_major']))
{
	if(isset($_POST['c']) && isset($_POST['m']))
	{
		if($_POST['c'] == "FormController")
		{
			$class = 'moodle\\controllers\\'.$_POST['c'];
			$class = new $class();
			$method = $_POST['m'];
			$class->$method($_POST['map_name'], $_POST['map_major']);
		}
	}
}
else if (isset($_POST['course_id']))
{
	if(isset($_POST['c']) && isset($_POST['m']))
	{
		if($_POST['c'] == "FormController")
		{
			$class = 'moodle\\controllers\\'.$_POST['c'];
			$class = new $class();
			$method = $_POST['m'];
			$class->$method($_POST['course_id'], $_POST['map_id']);
		}
	}
}
else if (!isset($_REQUEST['c']) && !isset($_REQUEST['m']))
{
	if($session_data['user_role'] == 0)
	{
		header("Location: index.php?c=NavigationController&m=adminDashboard");
	}
	else if ($session_data['user_role'] == 1)
	{
		header("Location: index.php?c=NavigationController&m=teacherDashboard");
	}
	else if ($session_data['user_role'] == 2)
	{
		$first = $session_data['first'];
		$last = $session_data['last'];
		$major = $session_data['major'];
		$location = "Location: index.php?c=NavigationController&m=mapView&arg1=".$major."&arg2".$first."&arg3=".$last;
		header($location);
	}
	else
	{
		
	}
}
else if (isset($_REQUEST['c']) && isset($_REQUEST['m']))
{
	$class = $_REQUEST['c'];
	if($class == "NavigationController")
	{
		$class = 'moodle\\controllers\\'.$class;
		$class = new $class();
		if(isset($_REQUEST['arg1']))
		{
			$session_data['major'] = $_REQUEST['arg1'];
		}
		if(isset($_REQUEST['arg2']) && !isset($_REQUEST['arg3']))
		{
			$session_data['map_id'] = $_REQUEST['arg2'];
		}
		if(isset($_REQUEST['arg2']) && isset($_REQUEST['arg3']))
		{
			$session_data['first'] = $_REQUEST['arg2'];
			$session_data['last'] = $_REQUEST['arg3'];
		}
		$method = $_REQUEST['m'];
		$class->$method($session_data);
	}
	else if ($class == "FormController")
	{
		if(isset($_REQUEST['arg2']) && isset($_REQUEST['arg1']))
		{
			$class = 'moodle\\controllers\\'.$class;
			$class = new $class();
			$method = $_REQUEST['m'];
			$class->$method($_REQUEST['arg1'], $_REQUEST['arg2']);
		}
		else if (isset($_REQUEST['arg1']))
		{
			$class = 'moodle\\controllers\\'.$class;
			$class = new $class();
			$method = $_REQUEST['m'];
			$class->$method($_REQUEST['arg1']);
		}
	}
}
else
{
	if (false) {
		$session_data['user_role'] = 0;
		$session_data['user_name'] = "Jorge Aguiniga";
		$session_data['user_id'] = "008214700";
		$a = new VIEW\AdminMapView($session_data);
		$a->render();
	}
	else if (false) {
		$session_data['students'] = [['user_id'=>2, 'first_name'=> "Jorge", 'last_name'=> "Aguiniga", 'map_name'=> "SE Fall 2016"], ['user_id'=>4, 'first_name'=> "Luis", 'last_name'=> "Otero", 'map_name'=> "SE Fall 2016"], ['user_id'=>7, 'first_name'=> "Kevin", 'last_name'=> "Dang", 'map_name'=> "SE Spring 2016"], ['user_id'=>14, 'first_name'=> "Yoho", 'last_name'=> "Chen", 'map_name'=> "SE Spring 2016"], ['user_id'=>19, 'first_name'=> "Andrew", 'last_name'=> "Javier", 'map_name'=> "CMPE Fall 2014"], ['user_id'=>20, 'first_name'=> "Jonathan", 'last_name'=> "Chen", 'map_name'=> "CMPE Fall 2014"]];
		$session_data['user_role'] = 1;
		$session_data['user_name'] = "Andy Kwan";
		$session_data['user_id'] = 1;
		$a = new VIEW\TeacherMapView($session_data);
		$a->render();
	}
	else if (false) {
		$session_data['maps'] = [['map_id' => 1, 'map_name' => "SE Fall 2014", 'major_name' => "Software Engineering Fall 2014"], ['map_id' => 2, 'map_name' => "SE Fall 2016", 'major_name' => "Software Engineering Fall 2016"], ['map_id' => 3, 'map_name' => "SE Spring 2016", 'major_name' => "Software Engineering Spring 2016"], ['map_id' => 4, 'map_name' => "CMPE Fall 2016", 'major_name' => "Computer Engineering Fall 2016"], ['map_id' => 5, 'map_name' => "CMPE Spring 2016", 'major_name' => "Computer Engineering Spring 2016"],];
		$session_data['user_role'] = 1;
		$session_data['user_name'] = "Andy Kwan";
		$session_data['user_id'] = 1;
		$a = new VIEW\EditMapView($session_data);
		$a->render();
	}
	else
	{
		header("Location: index.php");
	}
}