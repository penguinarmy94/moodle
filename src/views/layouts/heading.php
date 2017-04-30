<?php

class Heading {

	private $script;
	private $css;

    public function __construct($withExtras, $extras) {
    	if (isset($withExtras['has_script']) && isset($withExtras['has_css'])) {
    		if ($withExtras['has_script']) {
    			$this->script = $extras['script'];
    		}
			if ($withExtras['has_css']) {
    			$this->css = $extras['css'];
    		}
    	}
    }

	public function render ()
	{
		?>
			<!DOCTYPE html>
			<html>
			<head>
			<title>Moodle</title>
            <link rel="icon" href="src/resources/favicon_ora.ico" />
            <link rel="stylesheet" type="text/css" href="src/styles/templete.css" />
			<?php
			if (empty($this->script)) {
				?><link rel="stylesheet" type="text/css" href="<?= $this->css; ?>" /><?php
			}
			if (empty($this->css)) {
				?><script type="text/javascript" src="<?= $this->script; ?>"></script><?php
			}
			?>
			</head>
		<?php
	}
}