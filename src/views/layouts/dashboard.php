<?php
namespace moodle\views\layouts;

class Dashboard {

	private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

	public function render ()
	{
		echo '<div class="dashboard_nav">';

        ?>
        <nav class="link_group">
            <a class="dash_nav_links" href="index.php"><div class="dash_selection">Dashboard</div></a>
            <a class="dash_nav_links" href="index.php"><div class="dash_selection">Site Home</div></a>
            <a class="dash_nav_links" href="index.php"><div class="dash_selection">Calander</div></a>
            <a class="dash_nav_links" href="index.php"><div class="dash_selection">Private Homes</div></a>
            <br>
        </nav>

        <?php

        if ( $this->session_data['user_role'] == 0) {
            ?>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Site Administration</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Course Administration</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">User Administration</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Map Administration</div></a>
            <?php
        }
        else if ( $this->session_data['user_role'] == 1) {
            ?>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Courses</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Student Maps</div></a>
            <?php
        }
        else if ( $this->session_data['user_role'] == 2) {
            ?>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Courses</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Groups</div></a>
                <a class="dash_nav_links" href="index.php"><div class="dash_selection">Major Map</div></a>
            <?php
        }
        echo '</div>';

	}
}