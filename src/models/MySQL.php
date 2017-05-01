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
	
	public function getMapItems()
	{
		$returnValue = array();
		$sql = "select map_id, map_name, major_name from major_map join major on for_major_id = major_id";
		$result = $this->conn->query($sql);
		if($result != null)
		{
			for($x = 0; $x < mysqli_num_rows($result); $x++)
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$returnValue[] = ["map_id" => $row['map_id'], "map_name" => $row['map_name'], "major_name" => $row['major_name']];
			}
		}
		
		return $returnValue;
	}
	
	public function getMapCourses($map_id)
	{
		$returnValue = array();
		
		$sql = "select course_id, course_name, course_abbrev from course where course_id in (select course_id from major_map_coontents where map_id = ".$map_id.");";
		$result = $this->conn->query($sql);
		if($result != null)
		{
			for ($x = 0; $x < mysqli_num_rows($result); $x++)
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$returnValue[] = ["course_id" => $row['course_id'], "course_name" => $row['course_name'], "course_abbrev" => $row['course_abbrev']];
			}
		}
		
		return $returnValue;
	}
	
	public function getStudents($user)
	{
		$returnValue = array();
		
		$sql = "select user_id from courses_taking where course_id in (select course_id from courses_teaching where user_id = '".$user['user_id']."')";
		$result = $this -> conn -> query($sql);
		if($result != null && (mysqli_num_rows($result) > 0))
		{
			$user = array();
			for ($x = 0; $x < mysqli_num_rows($result); $x++)
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$sql2 = "select major_name from student join major on student.major_id = major.major_id where user_id = ".$row['user_id'].";";
				$sql3 = "select firstname, lastname from user where user_id = ".$row['user_id'].";";
				$result2 = $this->conn->query($sql2);
				if(mysqli_num_rows($result2) == 1)
				{
					$result3 = $this->conn->query($sql3);
					if(mysqli_num_rows($result3) == 1)
					{
						$row2 = $result2->fetch_array(MYSQLI_ASSOC);
						$row3 = $result3->fetch_array(MYSQLI_ASSOC);
						$returnValue[]= ["user_id" => $row['user_id'], "first_name" => $row3['firstname'], "last_name" => $row3['lastname'], "major" => $row2['major_name']];
					}
					else
					{
						break;
					}
				}
				else
				{
					break;
				}
			}
			
		}
		
		return $returnValue;
	}
	
	public function addNewMap ($mapName, $majorID)
	{
		$sql = "select major_id from major where major_id = ". $majorID.";";
		$result = $this->conn->query($sql);
		if($result != null)
		{
			$sql2 = "select major_id from major_map_coontents where for_major_id = ".$majorID.";";
			$result = $this->conn->query($sql2);
			if($result == null)
			{
				$sql3 = "insert into major_map (map_name, for_major_id) values ('".$mapName."','".$majorID."');";
				$this->conn->query($sql3);
				return true;
			}
			else
			{
				echo"<script>console.log('Found Duplicate');</script>";
			}
		}
		else
		{
			echo"<script>console.log('Could Not Find Major');</script>";
		}
		
		return false;
	}
	
	public function addNewCourse($id, $mapID)
	{
		$sql = "select course_id from course where course_id = ".$id.";";
		$result = $this->conn->query($sql);
		if($result != null)
		{
			$sql2 = "insert into major_map_coontents values ('".$mapID."','".$id."');";
			$this->conn->query($sql2);
			return true;
		}
		
		return false;
	}
	
	public function deleteMap($mapID)
	{
		$sql = "delete from major_map_coontents where map_id = ".$mapID.";";
		$sql2 = "delete from major_map where map_id = ".$mapID.";";
		$this->conn->query($sql);
		$this->conn->query($sql2);
	}
	
	public function deleteCourse($courseID, $mapID)
	{
		$sql = "delete from major_map_coontents where course_id = ".$courseID." and map_id = ".$mapID.";";
		$this->conn->query($sql);
	}
}

?>