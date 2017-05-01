<?php
namespace moodle\views;

require_once ("src/views/layouts/heading.php");
require_once ("src/views/layouts/footer.php");
require_once ("src/views/layouts/navbar.php");
require_once ("src/views/layouts/footing.php");
require_once ("src/views/layouts/dashboard.php");
use moodle\views\layouts as LYOT;

class EditMapCourseView {

    private $session_data;

    public function __construct($session_data) {
        $this->session_data = $session_data;
    }

    public function render() {
		$course_array = array();
		if(isset($this->session_data['courses']))
		{
			$course_array = $this->session_data['courses'];
		}
        $map_name = $this->session_data['major'];
        $map_id = $this->session_data['map_id'];
        $has = ['has_script' => false, 'has_css' => true];
        $be = ['css' => 'src/styles/EditMapCourseView.css'];
        $h = new LYOT\Heading($has, $be);
        $h->render();
        echo '<body>';
        $nav = new LYOT\NavBar($this->session_data['user_name']);
        $nav->render();
        $nav = new LYOT\Dashboard($this->session_data);
        $nav->render();
        ?>
        <div class="body_block">
            <div class="header_body_block"><h2 class="header_body_title"><?=$map_name?>'s Course List</h2></div>
            <table class="course_table">
                <tr><th class="table_header_id">Course ID</th><th class="table_header">Course Name</th><th class="table_header">Course Abbreviation</th><th class="empty_header"></th></tr>
                <?php
                    for ($i=0; $i < sizeof($course_array); $i++) {
                        $course = $course_array[$i];
                        $id = $course['course_id'];
                        $course_name = $course['course_name'];
                        $course_abbrev = $course['course_abbrev'];
                        ?>
                            <tr>
                                <td class="table_id"><?=$id?></td>
                                <td class="table_content"><?=$course_name?></td>
                                <td class="table_content"><?=$course_abbrev?></td>
                                <td class="table_button"><a class="button_link" href="index.php?c=FormController&m=deleteCourseFromMap&arg1=<?= $id ?>&arg2=<?= $map_id ?>"><div class="button_text">Delete</div></a></td>
                            </tr>
                        <?php
                    }

                ?>
            </table>

            <div class="new_course_form_block">
                <h3>Add New Course</h3>
                <form class="new_course_form" method="POST" action="index.php">
                    <label class="course_label" for="course_name">Course ID:</label>
                    <input class="course_text" type="text" name="course_id" id="course_id">
                    <br>
                    <input class="save" type="submit" name="add" value="Add new course" />
					<input type="hidden" name="c" value="FormController" />
					<input type="hidden" name="m" value="addCourseToMap" />
					<input type="hidden" name="map_id" value="<?= $map_id ?>" />
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