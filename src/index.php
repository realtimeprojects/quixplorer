<?php

umask(002); // Added to make created files/dirs group writable

require "_include/init.php";	// Init
Qx::useModule("ActionLoader");

ActionLoader::go();

?>
