<?php

class MySQL
{
	var $host = null;
	var $user = null;
	var $pass = null;
	var $conn = null;
	var $db = null;

	function __construct()
	{
		$this -> host = 'localhost';
		$this -> user = 'root';
		$this -> pass = '';
		$this -> db = 'moodle_db';
	}

	public function openConnection()
	{
		$this -> conn = new mysqli($this -> host, $this -> user, $this -> pass, $this -> db);
		if(mysqli_connect_errno())
		{
			echo new Exception("Could not establish connection with database");
		}
	}

	public function getConnection()
	{
		return $this -> conn;
	}

	public function retrieveStudentCourses($firstname, $lastname)
	{
		$returnValue = array();
		$sql = "select course_id from courses join courses_taken using course_id where firstname='".$firstname."', lastname='".$lastname."'";
		$result = $this -> connection -> query($sql);
		if($result != null)
		{
			for($x = 0; $x < mysqli_num_rows($result); $x++)
			{
				$row = $result -> fetch_array(MYSQLI_ASSOC)
				$returnValue[$x] = $row["course_id"];
			}
		}
		echo($returnValue);
		return $returnvalue;
	}

	public function retrieveMapCourses($major)
	{
		$returnValue = array();
		$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
		$result = $this -> connection -> query($sql);
		if($result != null && (mysqli_num_rows($result) == 1))
		{
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			$sql2 = "select course_id from map_contents where map_id = '".$row["map_id"]."'";
			$result = $this -> connection -> query($sql);
			if($result != null)
			{
				for($x = 0; $x < mysqli_num_rows($result); $x++)
				{
					$row = $result -> fetch_array(MYSQLI_ASSOC);
					$returnValue[$x] = $row["course_id"];
				}
			}
		}
		return $returnvalue;
	}

	public function retrieveMapCourseNames($major)
	{
		$returnValue = array();
		$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
		$result = $this -> connection -> query($sql);
		if($result != null && (mysqli_num_rows($result) == 1))
		{
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			$sql2 = "select course_name from courses where map_id = '".$row["map_id"]."'";
			$result = $this -> connection -> query($sql);
			if($result != null)
			{
				for($x = 0; $x < mysqli_num_rows($result); $x++)
				{
					$row = $result -> fetch_array(MYSQLI_ASSOC);
					$returnValue[$x] = $row["course_id"];
				}
			}
		}
		return $returnvalue;
	}

	// public function generateCourseDependencies($major)
	// {
	// 	$returnValue = array();
	// 	$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
	// 	$result = $this -> connection -> query($sql);
	// 	if($result != null && (mysqli_num_rows($result) == 1))
	// 	{
	// 		$row = $result -> fetch_array(MYSQLI_ASSOC);
	// 		$sql2 = "select course_name from courses where map_id = '".$row["map_id"]."'";
	// 		$result = $this -> connection -> query($sql);
	// 		if($result != null)
	// 		{
	// 			for($x = 0; $x < mysqli_num_rows($result); $x++)
	// 			{
	// 				$sql3 = "select course_id from "
	// 				$row = $result -> fetch_array(MYSQLI_ASSOC);
	// 				$returnValue[$x] = $row["course_id"];
	// 			}
	// 		}
	// 	}
	// 	return $returnvalue;
	// }
}

?>