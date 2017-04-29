<?php

require_once ("src/views/GraphView.php");
require_once ("src/views/LoginView.php");
require_once ("src/views/MySQL.php");

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
	if($class = "NavigationController")
	{
		$method = $_REQUEST['m'];
		if(isset($_REQUEST['arg1'])
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