<?php
namespace moodle\controllers;

require_once("src/models/MySQL.php");
use moodle\models as MODEL;

class FormController
{
	private $model;
	
	public function __construct()
	{
		$this->model = new MODEL\MySQL();
		$this->model->openConnection();
	}
	
	public function addMap($mapName, $majorID)
	{
		$input = $this->model->addNewMap($mapName, $majorID);
		header("Location: index.php");
	}
	
	public function addCourseToMap($courseID, $mapID)
	{
		$input = $this->model->addNewCourse($courseID, $mapID);
		header("Location: index.php");
	}
	
	public function deleteMap($mapID)
	{
		$this->model->deleteMap($mapID);
		header("Location: index.php");
	}
	
	public function deleteCourseFromMap($courseID, $mapID)
	{
		$this->model->deleteCourse($courseID, $mapID);
		header("Location: index.php");
	}
	
	
}