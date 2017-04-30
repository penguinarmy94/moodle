<?php

namespace moodle\views;

require_once("layouts/footer.php");
require_once("layouts/heading.php");

class LoginView
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
			<head>
			<title>Something</title>
			<style>
				div{ border: 1px solid black;}
				h1{margin: auto;}
			</style>
			</head>
			<body>
				<h1>user a - Homepage</h1>
				<div style="width:1102px; height:20px;">This is the user homepage.</div>
				<div style="float:left; width:300px; height:700px;">
					<form method="get" action="index.php?">
						<input type="submit" value="graph" style="margin:auto"/>
						<input type="hidden" name="c" value="NavigationController" />
						<input type="hidden" name="m" value="mapView" />
					</form>
				</div>
				<div style="float:left; width:800px; height:700px;">
					<p> bleh</p>
				</div>
			</body>
			</html>
		<?php
	}
}