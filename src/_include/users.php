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

     The Original Code is fun_users.php, released on 2003-03-31.

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
require_once "./_include/user.php";

//------------------------------------------------------------------------------
/**
	loads the user database for authenticating the users
*/
function user_load ()
{
	if (!file_exists("./_config/user.db"))
	{
		require "./_config/.htusers.php";
		_convert();
	}

	$fp = fopen("./_config/user.db", "r");
	$users = fgets($fp);
	$GLOBALS['users'] = unserialize($users);
	fclose($fp);
}

/**
  converts user structrue from "old style" into "new style"
  */
function _convert ()
{
	$nu = array();
	$nu['version'] = "3";

	foreach ($GLOBALS['users'] as $user)
	{
		$nu['users'][$user[0]] = new User(
			$user[0],	// name
			$user[1],	// password
			$user[2],	// home
			$user[3],	// url
			$user[4] ? true : false,	// show_hidden
			$user[5],	// no_access
			$user[6],	// permissions
			$user[7] ? true : false // active
			);
	}
	$nu['users']['anonymous'] = new User (
			'anonymous',
			NULL,
			'',
			'',
			false,
			false,
			0x0001,
			false
			);

	$fp = fopen("./_config/user.db", "w");
	fputs($fp, serialize($nu));
	fclose($fp);
}

//------------------------------------------------------------------------------
function _saveUsers ()
{
	// Write to File
	$fp = @fopen("./_config/user.db", "w");
	if ($fp===false)
		return false;	// Error

	fputs($fp, serialize($GLOBALS['users']));
	fclose($fp);
	
	return true;
}
//------------------------------------------------------------------------------
/**
	try to find the user with the username $user and the password $pass
	in the user table.

	if you provide NULL as password, no password and user active check
	is done. otherwise, this function returns the user, if $pass matches
	the user password and the user is active.

	if the user is inactive or the password mismatches, NULL is returned.
*/
function user_find ($user, $pass)
{
	$users = $GLOBALS["users"]["users"];

	// locate the user
	$userd = $users[$user];

	// if the user does not exist, return NULL
	if (!isset($userd))
		return NULL;

	debug("user_find(): user $user found");

	// if no password check should be done, return
	// the user
	if ($pass == NULL)
		return $userd;
		
	// check if the password matches
	if ($pass != $userd->password)
		return NULL;

	debug("user_find(): password checked successfully");

	// check if the user is active, the admin user
	// must not be inactive.
	if (!$userd->active && $user != 'admin')
		return NULL;

	// return the user if all checks are passed
	return $userd;
}

/**
  	returns an array of all users.
  */
function	users_get ()
{
	return $GLOBALS['users']['users'];
}

//------------------------------------------------------------------------------
/**
	activate the user with the given user name and password.

	this function tries to find the user with the given user name and
	password in the user database and tries to activate this user.

	if username and password matches to the content of the
	user database, the user is activated, it's home directory,
	home url and permissions are set in the global variable and the
	function returns true.

	if the user cannot be authenticated, the function returns false.

	@param	$user	user name of the user to be authenticated
	@param	$pass	password of the user to authenticate
*/
function user_activate($user, $pass) 
{
	debug("user_activate: $user, $pass");

	// try to find and authenticate the user.
	$data = user_find($user, $pass);

	// if the user could not be authenticated, return false.
	if ($data == NULL)
		return false;
	
	// store the user data in the globals variable
	$GLOBALS['__SESSION']["s_user"]	= $data;

	// return true on success.
	return true;
}
//------------------------------------------------------------------------------
/**
	updates the user data for the given user.

	@param user 	the user name of the user to update
	@param data	the user data array
	@param newname	the new name of the user. NULL if user name should not
			be changed.
*/
function user_update ($user, $new_data)
{
	// If the user does not exist and it is not a new
	// user, return an error
	if ($user != NULL && !user_exists($user))
	{
		debug("error saving user $user, $new_data->user, user does not exist");
		return false;
	}
	
	// Update an existing user
	if ($user == $new_data->name)
		$GLOBALS['users']['users'][$user] = $new_data;
	else
	{
		// Check if the new user name exists already
		if (user_exists($new_data->name))
			return "false";
		
		// delete the old user, if exists
		if ($user != NULL)
				unset($GLOBALS['users']['users'][$user]);
		$GLOBALS['users']['users'][$new_data->name] = $new_data;
	}
		
	return _saveUsers();
}

/**
  	changes the password of an user.

	@param $user	The username of the user to change the password.
	@param $oldpw	The old password of the user. If it is set to NULL,
			the old password is not checked before changing the
			password.
	@param $newpw	The new password of the user.
  */
function user_change_password ($user, $oldpw, $newpw)
{
	// Find the user
	$data = user_find($user, $oldpw != NULL ? md5(stripslashes($oldpw)) : NULL);

	if ($data == NULL)
		return "miscnouserpass";
	
	$data->password = md5(stripslashes($_REQUEST["newpwd1"]));

	if (!user_update($user, $data))
		return "chpass";
	return NULL;
}

//------------------------------------------------------------------------------

/**
  this function removes the user with the given user name from the
  user database.
*/
function user_remove ($user)
{
	$data = &user_find($user, NULL);

	if ($data == NULL)
		return false;
	unset($GLOBALS['users']['users'][$user]);
	
	return _saveUsers();
}
//------------------------------------------------------------------------------
/**
  this function returns the permission values of the user with the given
  user name.

  if the user is not found in the user database, this function returns
  NULL, otherwise, it returns the permissions of the user.
*/
function	user_get_permissions ($username)
{
	// try to find the user in the user database
	$data = user_find($username, NULL);

	// return NULL if the user does not exists
	if ($data == NULL)
		return NULL;

	// return the user permissions
	return $data->permissions;
}

/**
  Returns the user data of the current user.

  If no user is logged in, the anonymous user is returned,
  as long as this user is active. Otherwise, NULL is returned.
  */
function user_get_current ()
{
	// Check if we have an "registered" user.
	$user = $GLOBALS['__SESSION']["s_user"];

	// If not, use the anonymous user
	if (!isset($user))
		$user = user_find("anonymous", NULL);

	debug("user_get_current(): current user $user->name");
	// if the user is inactive, it must not be returned
	if (!$user->active)
		return NULL;
	debug("user_get_current(): returning user $user->name");
	return $user;
	
}
/**
  Returns the user name of the current user.
  */
function	user_get_current_username ()
{
	return user_get_current()->name;
}

/**
  Returns true if a user with the given user name
  exists.
  */
function user_exists ($name)
{
	return (isset($GLOBALS['users']['users'][$name]));
}

?>
