<?php

namespace moodle\controllers;

require_once("src/views/LoginView.php");
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
		$dataArray['prereqs'] = [[4, 9, 10], [8], [], [], [], []];
		
		if (!empty($dataArray))
		{
			$this->view = new VIEW\GraphView();
			if (isset($data['finished']))
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
	
	public function addView()
	{
		
	}
	
	public function editView()
	{
		
	}
}