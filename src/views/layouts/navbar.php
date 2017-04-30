<?php

class NavBar {

	private $user;

    public function __construct($user) {
        $this->user = $user;
    }

	public function render ()
	{
		?>
            <h1 class="nav_bar">
                <div>
                    <button class="nav_button">☰</button>
                    <a href="https://www.youtube.com/feed/subscriptions"><img class="nav_moodle_logo" height="24" width="84" src="src/resources/moodle-logo.png"/></a>
                    <div class="nav_user_block" >
                        <img class="nav_icon" src="src/resources/message.svg"/>
                        <img class="nav_icon" src="src/resources/notifications.svg"/>
                        <span  class="nav_username"><?= $this->user ?></span>
                        <img class="nav_user_pic" src="src/resources/f2.png"/>
                    </div>
                </div>
            </h1>
		<?php
	}
}