<?php
namespace moodle\views;

require_once("footer.php");
require_once("heading.php");


class View
{
	private $header;
	private $footer;
	
	public function __construct()
	{
		
	}
	
	public function render()
	{
		?>
			<!DOCTYPE html>
			<html>
			<head><title>bleh</title></head>
			<body>
			<form method="post" action="index.php?c=graphView&m=render">
				<input type="text" name="add" />
				<input type="submit" value="enter" />
			</form>
			</body>
			</html>
		<?php
	}
}