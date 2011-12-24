<?php
    global $page;
    _debug("displaying:" . qx_var_template_dir() . "/" . $page);
    require qx_var_template_dir() . "/header.php";
    require qx_var_template_dir() . "/" . $page;
    require qx_var_template_dir() . "/footer.php";
?>
