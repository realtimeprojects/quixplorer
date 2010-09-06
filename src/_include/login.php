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

     The Original Code is login.php, released on 2003-03-31.

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
	User Authentication Functions
	
	Have Fun...
------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------
require_once "./_include/users.php";
user_load();
//------------------------------------------------------------------------------
session_start();
if(isset($_SESSION)) 			$GLOBALS['__SESSION']=&$_SESSION;
elseif(isset($HTTP_SESSION_VARS))	$GLOBALS['__SESSION']=&$HTTP_SESSION_VARS;
else logout();
//------------------------------------------------------------------------------
/**
 Do the user authentication.
 
 If there is a valid session, try to authenticate the user using
 the session information. Otherwise display the login information.
 */
function login ()
{
	global $smarty;

	debug("login(): try to login..");

	// Check if we have a valid user session
	if ($_REQUEST['action'] != "login" && login_ok() != false)
	{
		debug("login(): login successfull");
		return;
	}

	$session = $GLOBALS['__SESSION'];

	// Check if we have valid login data from login form
	$user = $_REQUEST['p_user'];
	$pass = $_REQUEST['p_pass'];

	if(isset($user) && isset($pass))
	{
		debug("activating user $user, $pass");
		// Check Login
		if(!user_activate(stripslashes($user), md5(stripslashes($pass))))
		{
				$smarty->assign('message', $GLOBALS['error_msg']['miscnologin']);
				logout();
				return;
		}
		return;
	}
	
	// Ask for Login
	debug("displaying logon screen");
	$smarty->assign('action', 'login');
	$smarty->display('login.tpl');
	exit;
}

//------------------------------------------------------------------------------
/**
	Logout the user and forget any session information.
	
	After logoff, display the login page.
*/
function logout()
{
	global $smarty;
	$GLOBALS['__SESSION']=array();
	session_destroy();
	$smarty->assign('action', 'login');
	$smarty->display('login.tpl');
	exit;
}
//------------------------------------------------------------------------------
/**
  This function determines if a user has been authenticated or not.
*/
function login_ok ()
{
	$current_user = user_get_current();
	debug("current user is: $current_user->name");
	if ($current_user == NULL)
		return false;

	// try to activate the current user
	if (user_activate($current_user->name, $current_user->password) == true)
		return true;

	// if this fails, logout the user
	logout();
	return false;
}

?>
