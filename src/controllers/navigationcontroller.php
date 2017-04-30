<?php

namespace moodle\controllers;

require_once("src/views/GraphView.php");
require_once("src/views/MySQL.php");

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
		$dataArray['finished'] = $this->model->retrieveStudentCoursesTaken($user['first'], $user['last']);
		$dataArray['ids'] = $this->model->retrieveMapCourses($user['major']);
		$dataArray['courses'] = $this->model->retrieveMapCourseNames($user['major']);
		$dataArray['prereqs'] = $this->model->generateCourseDependencies($user['major']); //[[4, 9, 10], [8], [], [], [], []];
		
		if (!empty($dataArray))
		{
			$session_data['user_role'] = 1;
			$session_data['user_name'] = "Jorge Aguiniga";
			$session_data['user_id'] = "008214700";
			$this->view = new VIEW\GraphView($session_data);
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
		
	}
	
	public function addView($user)
	{
		
	}
	
	public function editView()
	{
		
	}
}