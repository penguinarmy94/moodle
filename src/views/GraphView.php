<?php
namespace moodle\views;

<<<<<<< HEAD
require_once("src/views/layouts/footer.php");
require_once("src/views/layouts/heading.php");
=======
require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");
>>>>>>> 9c877e8e9b0682286d21ceb0426dfc23780baaf9

use \Fhaculty\Graph\Graph as Graph;
use moodle\views\layouts as LYOT;


class GraphView
{
	private $header;
	private $footer;
<<<<<<< HEAD

	public function __construct()
=======
	private $session_data;
	
	public function __construct($session_data)
>>>>>>> 9c877e8e9b0682286d21ceb0426dfc23780baaf9
	{
		$this->session_data = $session_data;
	}
<<<<<<< HEAD

	public function render()
	{
		$courses = ["cs122", "cs135", "cs157", "cs172", "cs184", "cs197", "cs155", "cs185", "cs117"];
		$ids = [1,2,3,4, 5, 6, 7, 8, 9];
		$finished = [1,2,3];
		$map = [[2,3], [], [4],[5], [6,7,8], [9], [9], [9], []];

		$courselist = json_encode($courses);
		$idlist = json_encode($ids);
		$maplist = json_encode($map);
		$finishedlist = json_encode($finished);

		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>bleh</title>
				<script type="text/javascript" src="src/resources/node_modules/vis/dist/vis.js"></script>
				<link href="src/resources/node_modules/vis/dist/vis.css" rel="stylesheet" type="text/css" />
				<style type="text/css">
					#mynetwork {
						width: 800px;
						height: 600px;
						border: 1px solid lightgray;
						margin: auto;
					}
					#title {
						margin: 0 auto;
					}
					#label {
						width: 400px;
						height 20px;
						border 2px solid lightgray;
					}
				</style>
			</head>
			<body>
			<h1 id="title">My Network</div>
			<div id="label"></div>
			<div id="mynetwork"></div>
=======
	
	public function render($data)
	{	
		$courselist = json_encode($data['courses']);
		$idlist = json_encode($data['ids']);
		$maplist = json_encode($data['prereqs']);
		if($data['type'] == "admin")
		{
			$finishedlist = json_encode([]);
		}
		else
		{
			$finishedlist = json_encode($data['finished']);
		}
		
		$has = ['has_script' => true, 'has_css' => true];
        $be = ['css' => 'src/resources/node_modules/vis/dist/vis.css', 'script' => 'src/resources/node_modules/vis/dist/vis.js'];
        $h = new LYOT\Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new LYOT\NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new LYOT\Dashboard($this->session_data);
        $nav->render();	
			?> 
			<h1 id="title">My Network</h1>
			<div class="body_block">
				<div id="mynetwork"></div>
			</div>
>>>>>>> 9c877e8e9b0682286d21ceb0426dfc23780baaf9
			<script type="text/javascript">
					var courses = JSON.parse('<?= $courselist ?>');
					var ids = JSON.parse('<?= $idlist ?>');
					var map = JSON.parse('<?= $maplist ?>');
					var finished = JSON.parse('<?= $finishedlist ?>');
					var nodeArray = [];
					var edgeArray = [];
<<<<<<< HEAD

					var labeldata = {
						nodes: new vis.DataSet(labelArray),
						edges: new vis.DataSet(edgeArray)
					}

					labeldata.nodes.update([{id:-2, color:{background: "#ff5f0f"}}]);

=======
					
					
>>>>>>> 9c877e8e9b0682286d21ceb0426dfc23780baaf9
					for(i = 0; i < courses.length; i++)
					{
						nodeArray.push({id: ids[i], label: courses[i]});
						for (j = 0; j < map[i].length; j++)
						{
							edgeArray.push({from: map[i][j], to: ids[i]});
						}
					}

					var nodes = new vis.DataSet(nodeArray);

					for (i = 0; i < finished.length; i++)
					{
						nodes.update([{id:finished[i].toString(), color:{background: "#ff5f0f"}}]);
					}
					var edges = new vis.DataSet(edgeArray);

					// create a network
					var container = document.getElementById('mynetwork');

					// provide the data in the vis format
					var data = {
						nodes: nodes,
						edges: edges
					};

					var options = {
									edges:{
											arrows: 'to'
									}

								  };

					// initialize your network!
					var network = new vis.Network(container, data, options);
<<<<<<< HEAD
					var labels = new vis.Network(labelContainer, labeldata, options);

				</script>
			</body>
			</html>
=======
					
			</script>
>>>>>>> 9c877e8e9b0682286d21ceb0426dfc23780baaf9
		<?php
		$foot = new LYOT\Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new LYOT\Footer();
        $f->render();
	}
}