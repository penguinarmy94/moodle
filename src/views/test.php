<html>
<body>

<?php

	require(dirname(__FILE__) . "/MySQL.php");
	
	$mysql = new MySQL();
	$mysql -> openConnection();

	$ids = retrieveMapCourses("Software Engineering");
	$finished = retrieveStudentCourses("Kevin Dang");
?>

</body>
</html>