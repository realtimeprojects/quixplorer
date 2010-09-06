<?php

$lang = isset($_REQUEST["lang"]) ? $_REQUEST["lang"] : $GLOBALS["config"]['settings']['language'];
require "./_lang/$lang.php";
require "./_lang/" . $lang . "_mimes.php";
require "./_lang/_info.php";

?>
