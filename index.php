<?php


//require_once ("src/views/view.php");
require_once ("src/views/AdminMapView.php");
require_once ("src/views/TeacherMapView.php");
require_once ("src/views/EditMapView.php");
//require_once("vendor/autoload.php");

require_once ("src/views/GraphView.php");
require_once ("src/views/LoginView.php");
require_once ("src/views/MySQL.php");

use moodle\views as VIEW;

$session_data =  [];
//'courses' -> an array fo course abbrev.
//'ids' -> an array of course id corresponding to abbrev
//'finished' -> ids that correspond to what courses the user has finished
//'map' -> matrix of the next courses they can take
//'role' -> user role (0= admin, 1= teacher, 2= student)
//'user_role' -> id of user
//'name' ->


$number = 2;
if ($number == 0) {
    $session_data['user_role'] = 0;
    $session_data['user_name'] = "Jorge Aguiniga";
    $session_data['user_id'] = "008214700";
    $a = new AdminMapView($session_data);
    $a->render();
}
else if ($number == 1) {
    $session_data['students'] = [['user_id'=>2, 'first_name'=> "Jorge", 'last_name'=> "Aguiniga", 'map_name'=> "SE Fall 2016"], ['user_id'=>4, 'first_name'=> "Luis", 'last_name'=> "Otero", 'map_name'=> "SE Fall 2016"], ['user_id'=>7, 'first_name'=> "Kevin", 'last_name'=> "Dang", 'map_name'=> "SE Spring 2016"], ['user_id'=>14, 'first_name'=> "Yoho", 'last_name'=> "Chen", 'map_name'=> "SE Spring 2016"], ['user_id'=>19, 'first_name'=> "Andrew", 'last_name'=> "Javier", 'map_name'=> "CMPE Fall 2014"], ['user_id'=>20, 'first_name'=> "Jonathan", 'last_name'=> "Chen", 'map_name'=> "CMPE Fall 2014"]];
    $session_data['user_role'] = 1;
    $session_data['user_name'] = "Andy Kwan";
    $session_data['user_id'] = 1;
    $a = new TeacherMapView($session_data);
    $a->render();
}
else if ($number == 2) {
    $session_data['maps'] = [['map_id' => 1, 'map_name' => "SE Fall 2014", 'major_name' => "Software Engineering Fall 2014"], ['map_id' => 2, 'map_name' => "SE Fall 2016", 'major_name' => "Software Engineering Fall 2016"], ['map_id' => 3, 'map_name' => "SE Spring 2016", 'major_name' => "Software Engineering Fall 2016"], ['map_id' => 4, 'map_name' => "CMPE Fall 2016", 'major_name' => "Software Engineering Fall 2016"], ['map_id' => 5, 'map_name' => "CMPE Spring 2016", 'major_name' => "Software Engineering Fall 2016"],];
    $session_data['user_role'] = 1;
    $session_data['user_name'] = "Andy Kwan";
    $session_data['user_id'] = 1;
    $a = new EditMapView($session_data);
    $a->render();
}
else if ($number == 3) {

}
else if(isset($_POST['add']))
{
    $class = new VIEW\View();
    $method = "render";
    $class->$method();
    echo "<div>".$_POST['add']."</div>";
}
else if (isset($_REQUEST['c']) && isset($_REQUEST['m']))
{
	$class = $_REQUEST['c'];
	if($class = "NavigationController")
	{
		$method = $_REQUEST['m'];
		if(isset($_REQUEST['arg1']))
		{
			$class->$method($_REQUEST['arg1']);
		}
	}
}
else
{
	$class = new VIEW\GraphView();
	$method = "render";
	$class->$method();

}