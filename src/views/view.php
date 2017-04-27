<?php
namespace moodle\views;

require_once("footer.php");
require_once("heading.php");

use \Fhaculty\Graph\Graph as Graph;


class View
{
	private $header;
	private $footer;
	
	public function __construct()
	{
		
	}
	
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
			<script type="text/javascript">
					var courses = JSON.parse('<?= $courselist ?>');
					var ids = JSON.parse('<?= $idlist ?>');
					var map = JSON.parse('<?= $maplist ?>');
					var finished = JSON.parse('<?= $finishedlist ?>');
					var labelArray = [{id: -1, label: "Incomplete"}, {id: -2, label: "Complete"}];
					var nodeArray = [];
					var edgeArray = [];
					
					var labeldata = {
						nodes: new vis.DataSet(labelArray),
						edges: new vis.DataSet(edgeArray)
					}
					
					labeldata.nodes.update([{id:-2, color:{background: "#ff5f0f"}}]);
					
					for(i = 0; i < courses.length; i++)
					{
						nodeArray.push({id: ids[i], label: courses[i]});
						for (j = 0; j < map[i].length; j++)
						{
							edgeArray.push({from: ids[i], to: map[i][j]});
						}
					}
					
					var nodes = new vis.DataSet(nodeArray);
					
					for (i = 0; i < finished.length; i++)
					{
						nodes.update([{id:(i+1).toString(), color:{background: "#ff5f0f"}}]);
					}
					var edges = new vis.DataSet(edgeArray);

					// create a network
					var container = document.getElementById('mynetwork');
					var labelContainer = document.getElementById('label');

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
					var labels = new vis.Network(labelContainer, labeldata, options);
					
				</script>
			</body>
			</html>
		<?php
	}
}