<?php
namespace moodle\views;

class Heading
{
	public function render ($title)
	{
		?>
			<!DOCTYPE html>
			<html>
			<head>
			<title><?= $title ?></title>
			</head>
			<body>
		<?php
	}
}