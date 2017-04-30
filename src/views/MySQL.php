<?php
namespace moodle\models;

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
		$this -> conn = new \mysqli($this -> host, $this -> user, $this -> pass, $this -> db);
		if(mysqli_connect_errno())
		{
			echo new Exception("Could not establish connection with database");
		}
	}

	public function getConnection()
	{
		return $this -> conn;
	}

	public function retrieveStudentCoursesTaken($firstname, $lastname)
	{
		$returnValue = array();
		$sql = "select course_id from courses_taken
					where user_id = (select user_id from user where firstname='".$firstname."' and lastname='".$lastname."')";
		$result = $this -> conn -> query($sql);
		if($result != null)
		{
			for($x = 0; $x < mysqli_num_rows($result); $x++)
			{
				$row = $result -> fetch_array(MYSQLI_ASSOC);
				$content = $row['course_id'];
				$returnValue[] = $content;
			}
		}

		//echo($returnValue);
		return $returnValue;
	}

	public function retrieveMapCourses($major)
	{
		$returnValue = array();
		$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
		$result = $this -> conn -> query($sql);
		if($result != null && (mysqli_num_rows($result) == 1))
		{
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			$sql2 = "select course_id from 
						course where course_id in (select course_id from major_map_coontents where map_id = '".$row["map_id"]."')";
			$result = $this -> conn -> query($sql2);
			if($result != null)
			{
				for($x = 0; $x < mysqli_num_rows($result); $x++)
				{
					$row = $result -> fetch_array(MYSQLI_ASSOC);
					$returnValue[] = $row['course_id'];
				}
			}
		}
		return $returnValue;
	}

	public function retrieveMapCourseNames($major)
	{
		$returnValue = array();
		$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
		$result = $this -> conn -> query($sql);
		if($result != null && (mysqli_num_rows($result) == 1))
		{
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			$sql2 = "select course_abbrev from 
						course where course_id in (select course_id from major_map_coontents where map_id = '".$row["map_id"]."')";
			$result = $this -> conn -> query($sql2);
			if($result != null)
			{
				for($x = 0; $x < mysqli_num_rows($result); $x++)
				{
					$row = $result -> fetch_array(MYSQLI_ASSOC);
					$returnValue[] = $row["course_abbrev"];
				}
			}
		}
		return $returnValue;
	}

	public function generateCourseDependencies($major)
	{
		$returnValue = array();
		$sql = "select map_id from major_map where for_major_id = (select major_id from major where major_name = '".$major."')";
		$result = $this -> conn -> query($sql);
		if($result != null && (mysqli_num_rows($result) == 1))
		{
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			$sql2 = "select course_id from major_map_coontents where map_id = '".$row["map_id"]."'";
			$result = $this -> conn -> query($sql2);
			if($result != null)
			{
				for($x = 0; $x < mysqli_num_rows($result); $x++)
				{
					$row = $result -> fetch_array(MYSQLI_ASSOC);
					$sql3 = "select prerequisite from course_requirements where course_id = '".$row["course_id"]."'";
					$result2 = $this -> conn -> query($sql3);
					$preq = array();
					for($y = 0; $y < mysqli_num_rows($result2); $y++)
					{
						$row = $result2 -> fetch_array(MYSQLI_ASSOC);
						$preq[] = $row["prerequisite"];
					}
					$returnValue[] = $preq;
				}
			}
		}
		return $returnValue;
	}
}

?>