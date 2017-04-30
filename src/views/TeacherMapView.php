<?php

require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");


class TeacherMapView {

    private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

    public function render() {
        $student_array = $this->session_data['students'];
        $has = ['has_script' => false, 'has_css' => true];
        $be = ['css' => 'src/styles/TeacherMapView.css'];
        $h = new Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new Dashboard($this->session_data);
        $nav->render();
        ?>
        <div class="body_block">
            <div class="header_body_block"><h2 class="header_body_title">Student Maps</h2></div>
            <table>
                <tr><th class="table_header_id">SJSU ID</th><th class="table_heaer">Studnet Name</th><th class="table_heaer">Map</th><th class="view_header"></th></tr>
                <?php
                    for ($i=0; $i < sizeof($student_array); $i++) {
                        $student = $student_array[$i];
                        $id = $student['user_id'];
                        $name = $student['first_name']." ".$student['last_name'];
                        $map = $student['map_name'];
                        ?>
                            <tr>
                                <td class="table_id"><?=$id?></td>
                                <td class="table_content"><?=$name?></td>
                                <td class="table_content"><?=$map?></td>
                                <td class="view_button"><a class="button_link" href=""><div class="button_text">View</div></a></td>
                            </tr>
                        <?php
                    }

                ?>

            </table>
        </div>
        <?php
        $foot = new Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new Footer();
        $f->render();
    }

}
