<?php

class Footing {

    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render ()
    {
        ?>
            <footer class="footer_bar">
                <div class="footer_bar_container">
                    <div>
                        You are logged in as <a href="index.php"><?=$this->user?></a> (<a href="index.php">Log Out</a>)
                    </div>
                    <div><a href="index.php">Home</a></div>
                </div>
            </footer>
        <?php
    }
}