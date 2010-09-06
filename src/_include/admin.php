<?php
/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is fun_admin.php, released on 2003-03-31.

     The Initial Developer of the Original Code is The QuiX project.

     Alternatively, the contents of this file may be used under the terms
     of the GNU General Public License Version 2 or later (the "GPL"), in
     which case the provisions of the GPL are applicable instead of
     those above. If you wish to allow use of your version of this file only
     under the terms of the GPL and not to allow others to use
     your version of this file under the MPL, indicate your decision by
     deleting  the provisions above and replace  them with the notice and
     other provisions required by the GPL.  If you do not delete
     the provisions above, a recipient may use your version of this file
     under either the MPL or the GPL."
------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------
Author: The QuiX project
	quix@free.fr
	http://www.quix.tk
	http://quixplorer.sourceforge.net

Comment:
	QuiXplorer Version 2.3
	Administrative Functions
	
	Have Fun...
------------------------------------------------------------------------------*/

require "./_include/permissions.php";

//------------------------------------------------------------------------------
/**
  This function will show the admin interface for changing permissions,
  adding users and changing passwords.
  */
function admin_display ($admin, $dir)
{
	global $smarty;

	//show_header($GLOBALS["messages"]["actadmin"]);
	
	// Javascript functions:
	$smarty->assign("javascript", "./_include/admin.js");
	
	$smarty->assign("messages", $GLOBALS['messages']);
	$smarty->assign("error_msg", $GLOBALS['error_msg']);
	$smarty->assign("admin", $admin);
	$smarty->assign("logon_user", user_get_current_username());

	// Edit / Add / Remove User
	$users = users_get();
	$smarty->assign("users", $users);
	$smarty->assign("site_name", $GLOBALS['config']['site']['name']);
	$smarty->display('admin.tpl');
}
//------------------------------------------------------------------------------
function admin_changepwd ($dir)
{
	$username = user_get_current_username();


	_admin_change_password($username, $_REQUEST["oldpwd"], $_REQUEST["newpwd1"], $_REQUEST["newpwd2"]);

	// Activate the new user
	user_activate($username, $_REQUEST['newpwd1']);
	
	header("location: ".make_link("list",$dir,NULL));
}
//------------------------------------------------------------------------------
function admin_adduser ($dir)
{
	$_REQUEST['user'] = NULL;
	admin_edituser($dir);
}

//------------------------------------------------------------------------------
function admin_edituser ($dir)
{
	// Determine the user name from the post data	
	$user = stripslashes($_REQUEST["user"]);

	// try to find the user
	if ($user != NULL)
	{
		$data = user_find($user, NULL);
		if ($data == NULL)
			show_error($user.": ".$GLOBALS["error_msg"]["miscnofinduser"]);
	}
	else
		$data = new User (
				'',
				NULL,
				".",
				"http://localhost",
				false,
				"^\.ht",
				0x0000,
				false
			      );

	// check if we have to edit the user currently logged on
	if ($self = ($user == user_get_current()))
		$dir="";
	
	// Check if the user has been edited and has to be stored
	if(isset($_REQUEST["confirm"]) && $_REQUEST["confirm"] == "true")
	{
		$nuser=stripslashes($_REQUEST["nuser"]);
		if (!isset($nuser) || empty($nuser))
			$nuser = $user;
		debug("admin_edituser(): new username: '$nuser' ($user)");
		if ($nuser == "" || $_REQUEST["home_dir"] == "")
		{
			show_error($GLOBALS["error_msg"]["miscfieldmissed"]);
		}
		
		
		// Ensure the user cannot disable hisself
		if ($self)
			$_REQUEST["active"] = true;
	
		// determine the user permissions
		$permissions = _eval_permissions();

		// determine the new user data
		$data = new User(
				$nuser,
				NULL,
				stripslashes($_REQUEST["home_dir"]),
				stripslashes($_REQUEST["home_url"]),
				$_REQUEST["show_hidden"],
				stripslashes($_REQUEST["no_access"]),
				$permissions,
				$_REQUEST["active"]);
			
		if (!user_update($user, $data))
			show_error($user.": ".$GLOBALS["error_msg"]["saveuser"]);

		if (isset($_REQUEST["chpass"]) && $_REQUEST['chpass'] == "true")
		{
			// Change the password via the function
			_admin_change_password($nuser, NULL, $_REQUEST["pass1"], $_REQUEST["pass2"]);
		}

		if ($self)
			user_activate($nuser, NULL);
		
		header("location: ".make_link("admin",$dir,NULL));
		return;
	}
	
	global $smarty;
	$smarty->assign("user", $user);
	$smarty->assign("logon_user", user_get_current_username());
	$smarty->assign("status", 
			$user != NULL	? sprintf($GLOBALS["messages"]["miscedituser"], $user)
					: $GLOBALS["messages"]["miscadduser"]);
	$smarty->assign("data", $data);	
	$smarty->assign("self", $self);
	$smarty->assign("messages", $GLOBALS['messages']);
	$smarty->assign("permvalues", admin_make_permissions($user));
	$smarty->assign("editname", $user != "admin" && $user != "anonymous");

	// Javascript functions:
	$smarty->assign("javascript", "./_include/admin3.js");
	$smarty->display("edituser.tpl");
}
//------------------------------------------------------------------------------
function admin_removeuser ($dir)
{
	// Remove User
	$user = stripslashes($GLOBALS['__POST']["user"]);

	// Deleting 'ourself' is not allowed
	if($user == user_get_current_username())
		show_error($GLOBALS["error_msg"]["miscselfremove"]);

	// Deleting "anonymous" and "admin" user is not allowed
	if ($user == "admin" || $user == "anonymous")
		show_error($GLOBALS["error_msg"]["miscselfremove"]);

	if (!user_remove($user))
		show_error($user.": ".$GLOBALS["error_msg"]["deluser"]);
	
	header("location: " . make_link("admin",$dir,NULL));
}
//------------------------------------------------------------------------------
function admin_show ($dir)
{
	$admin = permissions_grant(NULL, NULL, "admin");
	
	if (!login_ok())
		show_error($GLOBALS["error_msg"]["miscnofunc"]);
	if (!$admin && !permissions_grant(NULL, NULL, "password"))
		show_error($GLOBALS["error_msg"]["accessfunc"]);
	
	if(isset($GLOBALS['__GET']["action2"])) $action2 = $GLOBALS['__GET']["action2"];
	elseif(isset($GLOBALS['__POST']["action2"])) $action2 = $GLOBALS['__POST']["action2"];
	else $action2="";
	
	switch($action2) {
	case "chpwd":
		admin_changepwd($dir);
	break;
	case "adduser":
		if(!$admin) show_error($GLOBALS["error_msg"]["accessfunc"]);
		admin_adduser($dir);
	break;
	case "edituser":
		if(!$admin) show_error($GLOBALS["error_msg"]["accessfunc"]);
		admin_edituser($dir);
	break;
	case "rmuser":
		if(!$admin) show_error($GLOBALS["error_msg"]["accessfunc"]);
		admin_removeuser($dir);
	break;
	default:
		admin_display($admin,$dir);
	}
}
//------------------------------------------------------------------------------
/**
	print out the html permission table to modify user permissions.

	the name of the permission values are determined via the language
	interface. In case of there is no entry in the language table for
	this permission, the function uses the original permission name.
*/
function admin_make_permissions ($username)
{
	$permvalues = permissions_get();
	$ret = array();
	foreach ($permvalues as $name => $value)
	{
		$ret[$name] = array
			(
				"checked" =>  permissions_grant_user($username, NULL, NULL, $name),
				"disabled" => ($username == "admin") && ($name == "admin"),
				"value" => $value
			);
	}
	return $ret;
}


/**
  this function evaluates the changed permissions out of the html input form and convert this permissions
  into the permission values for storing them into the user database.
*/
function	_eval_permissions ()
{
	$perms = $GLOBALS['__POST']["permsettings"];
	$permissions = 0;
	if (!isset($perms))
		return $permissions;

	foreach ($perms as $values)
	{
		$permissions += $values;
	}

	return $permissions;
}

function _admin_change_password ($username, $old, $new1, $new2)
{
	// Old and new password must not be identical
	if ($old == $new1)
		show_error($GLOBALS["error_msg"]["miscnopassdiff"]);

	// The password and password confirmation have to be identical
	if ($new1 != $new2)
		show_error($GLOBALS["error_msg"]["miscnopassmatch"]);

	// Change the password in the user database
	$ret = user_change_password($username, $old, $new);

	// Check for errors
	if ($ret != NULL)
		show_error($GLOBALS["error_msg"][$ret]);	
}
?>
