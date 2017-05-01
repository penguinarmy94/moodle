<?php
namespace moodle\views;


require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");

use \Fhaculty\Graph\Graph as Graph;
use moodle\views\layouts as LYOT;


class GraphView
{
	private $header;
	private $footer;
	private $session_data;

	public function __construct($session_data)
	{
		$this->session_data = $session_data;
	}

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
			<script type="text/javascript">
					var courses = JSON.parse('<?= $courselist ?>');
					var ids = JSON.parse('<?= $idlist ?>');
					var map = JSON.parse('<?= $maplist ?>');
					var finished = JSON.parse('<?= $finishedlist ?>');
					var nodeArray = [];
					var edgeArray = [];
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
			</script>
		<?php
		$foot = new LYOT\Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new LYOT\Footer();
        $f->render();
	}
}