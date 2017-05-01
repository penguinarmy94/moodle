<?php

namespace moodle\controllers;

require_once("src/views/GraphView.php");
require_once("src/models/MySQL.php");

use moodle\views as VIEW;
use moodle\models as MODEL;


class NavigationController
{
	private $view;
	private $model;
	
	public function __construct()
	{
		$this->model = new MODEL\MySQL();
		$this->model->openConnection();
	}
	
	public function mapView($user)
	{
		if(isset($user['first']) && isset($user['last']))
		{
			$dataArray['finished'] = $this->model->retrieveStudentCoursesTaken($user['first'], $user['last']);
		}
		
		$dataArray['ids'] = $this->model->retrieveMapCourses($user['major']);
		$dataArray['courses'] = $this->model->retrieveMapCourseNames($user['major']);
		$dataArray['prereqs'] = $this->model->generateCourseDependencies($user['major']); //[[4, 9, 10], [8], [], [], [], []];
		
		if (!empty($dataArray['ids']) && !empty($dataArray['courses']) && !empty($dataArray['prereqs']))
		{
			$this->view = new VIEW\GraphView($user);
			if (!isset($dataArray['finished']))
			{
				$dataArray['type'] = "admin";
			}
			else
			{
				$dataArray['type'] = "other";
			}
			$this->view->render($dataArray);
		}
		else
		{
			header("Location: index.php");
		}
		
	}
	
	public function adminDashboard($user)
	{
		
	}
	
	public function teacherDashboard($user)
	{
		$session_data['students'] = $this->model->getStudents($user);
		$this->view = new VIEW\TeacherMapView($session_data);
	}
	
	public function editMap($user)
	{
		
	}
}