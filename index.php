<?php

require_once ("src/views/view.php");

use moodle\views as VIEW;

if(isset($_POST['add']))
{
	$class = new VIEW\View();
	$method = "render";
	$class->$method();
	echo "<div>".$_POST['add']."</div>";
}
else
{
	$class = new VIEW\View();
	$method = "render";
	$class->$method();
}