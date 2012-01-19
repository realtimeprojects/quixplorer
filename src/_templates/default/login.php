<br>
<form action="<?php echo qx_link("authenticate"); ?>" method="post" >
<table id="qx_login">
    <tr>
        <th colspan="2">
              <?php qx_msg("login.prompt"); ?>
        </th>
    </tr>
    <tr>
        <td><?php qx_msg("user.username") ?></td>
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
<input type="submit" value="<?php qx_msg("button.login"); ?>">
</form>
<script type="text/javascript">
	if(document.forms[0])
         document.forms[0].loginname.focus();
</script>

