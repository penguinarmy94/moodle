<?php
namespace moodle\views;

require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");

use moodle\views\layouts as LYOT;

class StudentMapView{

    private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

    public function render() {
        $has = ['has_script' => false, 'has_css' => true];
        $be = ['css' => 'src/styles/AdminMabView.css'];
        $h = new LYOT\Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new LYOT\NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new LYOT\Dashboard($this->session_data);
        $nav->render();
        ?>
        <div class="body_block">
			<!--
            <div class="header_body_block"><h2 class="header_body_title">Map Administration</h2></div>
            <div class="map_block">
                <div class="map_button_block"><a class="button_link" href="index.php?c=NavigationController&m=adminDashboard"><div class="button_text">Add New Map</div></a></div>
                <div class="map_description_block"><p class="map_description">Add a new major map to the system</p></div>
            </div>
            <br/>
            <div class="map_block">
                <div class="map_button_block"><a class="button_link" href=""><div class="button_text">Edit Map</div></a></div>
                <div class="map_description_block"><p class="map_description">Edit an existing major map in the system</p></div>
            </div>
            <br/>
            <div class="map_block">
                <div class="map_button_block"><a class="button_link" href="index.php?c=NavigationController&m=mapView"><div class="button_text">View Map</div></a></div>
                <div class="map_description_block"><p class="map_description">view a major map to the system</p></div>
            </div>
			-->
        </div>
        <?php
        $foot = new LYOT\Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new LYOT\Footer();
        $f->render();
    }

}
