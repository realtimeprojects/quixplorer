<?php

session_id($argv[1]);

parse_str($argv[2], $_GET);
parse_str($argv[2], $_POST);
parse_str($argv[2], $_REQUEST);

require "index.php"
?>
