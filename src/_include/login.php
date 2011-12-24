<?php

require_once "./_include/user.php";
require_once "qx_var.php";
user_load();

session_start();

_check_login();

function _check_login()
{
    global $require_login;

    // if no login is required, there is nothing to do
    if (!$require_login)
        return;

    // if the user is already authenticated, we're done
	if (!isset($_SESSION["s_user"]))
        return;

    // login the user
    login();
}

//FIXME update home_dir variable if user is logged in
function login ()
{
	if(isset($GLOBALS['__SESSION']["s_user"])) {
		if(!user_activate($GLOBALS['__SESSION']["s_user"],$GLOBALS['__SESSION']["s_pass"])) {
			logout();
		}
	} else {
		if(isset($GLOBALS['__POST']["p_pass"])) $p_pass=$GLOBALS['__POST']["p_pass"];
		else $p_pass="";
		
		if(isset($GLOBALS['__POST']["p_user"])) {
			// Check Login
			if(!user_activate(stripslashes($GLOBALS['__POST']["p_user"]), md5(stripslashes($p_pass)))) {
				logout();
			}
			// authentication sucessfull
			return;
		} else {
			// Ask for Login
            require_once qx_var_template_dir() . "/header.php";
			echo "<BR><TABLE width=\"300\"><TR><TD colspan=\"2\" class=\"header\" nowrap><B>";
			echo $GLOBALS["messages"]["actloginheader"]."</B></TD></TR>\n<FORM name=\"login\" action=\"";
			echo make_link("login",NULL,NULL)."\" method=\"post\">\n";
			echo "<TR><TD>".$GLOBALS["messages"]["miscusername"].":</TD><TD align=\"right\">";
			echo "<INPUT name=\"p_user\" type=\"text\" size=\"25\"></TD></TR>\n";
			echo "<TR><TD>".$GLOBALS["messages"]["miscpassword"].":</TD><TD align=\"right\">";
			echo "<INPUT name=\"p_pass\" type=\"password\" size=\"25\"></TD></TR>\n";
			echo "<TR><TD>".$GLOBALS["messages"]["misclang"].":</TD><TD align=\"right\">";
			echo "<SELECT name=\"lang\">\n";
			@include "./_lang/_info.php";
			echo "</SELECT></TD></TR>\n";
			echo "<TR><TD colspan=\"2\" align=\"right\"><INPUT type=\"submit\" value=\"";
			echo $GLOBALS["messages"]["btnlogin"]."\"></TD></TR>\n</FORM></TABLE><BR>\n";
?><script language="JavaScript1.2" type="text/javascript">
<!--
	if(document.login) document.login.p_user.focus();
// -->
</script><?php
            require_once qx_var_template_dir() . "/footer.php";
			exit;
		}
	}
}

function logout ()
{
	$GLOBALS['__SESSION']=array();
	session_destroy();
	header("location: ".$GLOBALS["script_name"]);
}

?>
