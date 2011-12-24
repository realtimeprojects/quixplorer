<br>
<table id="qx_login">
    <tr>
        <th colspan="2">
              <?php qx_msg("login.prompt"); ?>
        </th>
    </tr>
    <form name="login_form" action="<?php qx_link("login") ?>" method="post">
    <tr>
        <td><?php qx_msg("user.username") ?></td>
        <td align="right"><input name="loginname" type="text" size="20%"></input></td>
   </tr>
   <tr>
        <td><?php qx_msg("password") ?></td>
        <td align="right"><input name="password" type="text" size="20%"></input></td>
    </tr>
    <tr>
        <td><?php qx_msg("language") ?></td>
        <td align="right">
            <!-- FIXME -->
	        <select name="language"><?php @include "./_lang/_info.php" ?></select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input type="submit" value="<?php qx_msg("button.login"); ?>">
        </td>
    </tr>
    </form>
</table>
<script language="JavaScript1.2" type="text/javascript">
<!--
	if(document.login) document.login.loginname.focus();
// -->
</script>

