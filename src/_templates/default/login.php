<br>
<form id="login_form" action="<?php echo qx_link("authenticate"); ?>" method="post" >
<div id="login_header">
  <?php qx_msg("messages.login"); ?>
</div>
<table id="qx_login">
    <tr>
        <td><?php qx_msg("username") ?></td>
        <td align="right"><input name="loginname" type="text" size="20%"></td>
   </tr>
   <tr>
        <td><?php qx_msg("password") ?></td>
        <td align="right"><input name="password" type="password" size="20%"></td>
    </tr>
    <tr>
        <td><?php qx_msg("language") ?></td>
        <td align="right">
            <!-- FIXME -->
	        <select name="language"><?php @include "./_lang/_info.php" ?></select>
        </td>
    </tr>
</table>
<input id="login_button" type="submit" value="<?php qx_msg("buttons.login"); ?>">
</form>
<script type="text/javascript">
	if(document.forms[0])
         document.forms[0].loginname.focus();
</script>

