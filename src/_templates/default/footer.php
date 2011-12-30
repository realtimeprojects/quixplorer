<div class="footer">
    <hr>
        <a class="title" href="https://github.com/realtimeprojects/quixplorer" target="_blank"><?php qx_version_info() ?></a>
        <?php if (!qx_var_authenticated()) { ?>
        <a href="<?php echo qx_link("login"); ?>">login</a>
        <?php } ?>
</div>
</div> <!-- qx class -->
</body>
</html>
