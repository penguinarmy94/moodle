<?php

require_once ("src/views/GraphView.php");
require_once ("src/views/LoginView.php");
require_once ("src/controllers/navigationcontroller.php");

use moodle\views as VIEW;

if(isset($_POST['add']))
{
	$class = new VIEW\View();
	$method = "render";
	$class->$method();
	echo "<div>".$_POST['add']."</div>";
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
		$data['courses'] = ["cs122", "cs135", "cs157", "cs172", "cs184", "cs197", "cs155", "cs185", "cs117"];
		$data['ids'] = [1,2,3,4, 5, 6, 7, 8, 9];
		$data['finished'] = [1,2,3];
		$data['prereqs'] = [[0], [1], [1], [3], [4], [5], [5], [5], [6,7,8]];
	$class = new VIEW\GraphView();
	$method = "render";
	$class->$method($data);
}