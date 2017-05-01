<?php
namespace moodle\views;

require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");

use moodle\views\layouts as LYOT;


class AdminMapView {

    private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

    public function render() {
        $map_array = $this->session_data['maps'];
        $has = ['has_script' => false, 'has_css' => true];
        $be = ['css' => 'src/styles/EditMapView.css'];
        $h = new LYOT\Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new LYOT\NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new LYOT\Dashboard($this->session_data);
        $nav->render();
        ?>
        <div class="body_block">
            <div class="header_body_block"><h2 class="header_body_title">Edit Maps</h2></div>
            <table class="map_table">
                <tr><th class="table_header_id">Map ID</th><th class="table_header">Map Name</th><th class="table_header">Major</th><th class="empty_header"></th><th class="empty_header"></th><th class="empty_header"></th></tr>
                <?php
                    for ($i=0; $i < sizeof($map_array); $i++) {
                        $map = $map_array[$i];
                        $id = $map['map_id'];
                        $map_name = $map['map_name'];
                        $major_name = $map['major_name'];
                        ?>
                            <tr>
                                <td class="table_id"><?=$id?></td>
                                <td class="table_content"><?=$map_name?></td>
                                <td class="table_content"><?=$major_name?></td>
                                <td class="table_button"><a class="button_link" href="index.php?c=NavigationController&m=mapView&arg1=<?= $major_name ?>"><div class="button_text">View</div></a></td>
                                <td class="table_button"><a class="button_link" href="index.php?c=NavigationController&m=editView&arg1=<?= $major_name ?>&arg2=<?= $id ?>"><div class="button_text">Edit</div></a></td>
                                <td class="table_button"><a class="button_link" href="index.php?c=FormController&m=deleteMap&arg1=<?= $id ?>"><div class="button_text">Delete</div></a></td>
                            </tr>
                        <?php
                    }

                ?>
            </table>

            <div class="new_map_form_block">
                <h3>Add New Map</h3>
                <form class="new_map_form" method="POST" action="index.php">
                    <label class="map_label" for="map_name">Map Name:</label>
                    <input class="map_text" type="text" name="map_name" id="map_name">
                    <br>
                    <label class="map_label" for="map_major">Major ID:</label>
                    <input class="map_text" type="text" name="map_major" id="map_major">
                    <br>
                    <input class="save" type="submit" name="add" value="Add new map" />
					<input type="hidden" name="c" value="FormController" />
					<input type="hidden" name="m" value="addMap" />
                </form>
            </div>
        </div>
        <?php
        $foot = new LYOT\Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new LYOT\Footer();
        $f->render();
    }

}