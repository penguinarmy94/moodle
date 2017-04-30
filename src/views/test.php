<html>
<body>

<?php

	require(dirname(__FILE__) . "/MySQL.php");
	
	$mysql = new MySQL();
	$mysql -> openConnection();

	$ids = $mysql->retrieveMapCourses("Software Engineering");
	$courses = $mysql ->retrieveMapCourseNames("Software Engineering");
	$finished = $mysql->retrieveStudentCoursesTaken("Kevin", "Dang");
	$map = $mysql->generateCourseDependencies("Software Engineering");
	
?>

</body>
</html>