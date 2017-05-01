<?php
namespace moodle\views;

require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");

use moodle\views\layouts as LYOT;

class TeacherMapView {

    private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

    public function render() {
        $student_array = $this->session_data['students'];
        $has = ['has_script' => false, 'has_css' => true];
        $be = ['css' => 'src/styles/TeacherMapView.css'];
        $h = new LYOT\Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new LYOT\NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new LYOT\Dashboard($this->session_data);
        $nav->render();
        ?>
        <div class="body_block">
            <div class="header_body_block"><h2 class="header_body_title">Student Maps</h2></div>
            <table>
                <tr><th class="table_header_id">SJSU ID</th><th class="table_heaer">Studnet Name</th><th class="table_heaer">Major</th><th class="view_header"></th></tr>
                <?php
                    for ($i=0; $i < sizeof($student_array); $i++) {
                        $student = $student_array[$i];
                        $id = $student['user_id'];
                        $name = $student['first_name']." ".$student['last_name'];
                        $major = $student['major'];
                        ?>
                            <tr>
                                <td class="table_id"><?=$id?></td>
                                <td class="table_content"><?=$name?></td>
                                <td class="table_content"><?=$major?></td>
                                <td class="view_button"><a class="button_link" href="index.php?c=NavigationController&m=mapView&arg1=<?= $major ?>&arg2=<?= $student['first_name']?>&arg3=<?= $student['last_name']?>"><div class="button_text">View</div></a></td>
                            </tr>
                        <?php
                    }

                ?>

            </table>
        </div>
        <?php
        $foot = new LYOT\Footing($this->session_data['user_name']);
        $foot->render();
        echo '</body>';
        $f = new LYOT\Footer();
        $f->render();
    }

}
