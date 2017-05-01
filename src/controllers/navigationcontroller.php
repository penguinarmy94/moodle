<?php

namespace moodle\controllers;

require_once("src/views/GraphView.php");
require_once("src/views/AdminMapView.php");
require_once("src/views/EditMapCourseView.php");
require_once("src/views/TeacherMapView.php");
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
		$user['maps'] = $this->model->getMapItems();
		if($user['maps'] != null)
		{
			$this->view = new VIEW\AdminMapView($user);
			$this->view->render();
		}
		else
		{
			header("Location: index.php");
		}
	}
	
	public function teacherDashboard($user)
	{
		$user['students'] = $this->model->getStudents($user);
		if($user['students'] != null)
		{
			$this->view = new VIEW\TeacherMapView($user);
			$this->view->render();
		}
	}
	
	public function editView($user)
	{
		$user['courses'] = $this->model->getMapCourses($user['map_id']);
		if($user['courses'] != null)
		{
			$this->view = new VIEW\EditMapCourseView($user);
			$this->view->render();
		}
		else
		{
			$this->view = new VIEW\EditMapCourseView($user);
			$this->view->render();
		}
	}
}