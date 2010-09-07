<?php
/**
 * Error handling functions
 * 
 * @author: Claudio Klingler, The QuiX project
 */

/**
 * Print out a warning to the user.
 * 
 * @param $with_message Text of the warning message
 * @param $and_details	Some more details on the warning
 */
function warn ($with_message, $and_details = NULL)
{
		echo "<h3>$with_message</h3>";
		if ($and_details != NULL)
			echo "<h4>$and_details</h4>";
}

/**
 * Show an error message.
 * 
 * If the smarty template engine has already been loaded,
 * the error will be printed using the corresponding template,
 * otherwise a simple <h2>message</h2> is printed out.
 */
function show_error ($error, $extra = NULL)
{
	global $smarty;
	if (!defined($smarty))
	{
		echo "<h2>$error</h2>";
		if ($extra != NULL)
			echo "<h4>$extra</h4>";
		exit;
	}
	
	$smarty->assign('status', $GLOBALS["error_msg"]["error"]);
	$smarty->assign('error', $GLOBALS["error_msg"]["error"]);
	$smarty->assign('message', $error);
	$smarty->assign('details', $extra);
	$smarty->assign('back', $GLOBALS["error_msg"]["back"]);
	$smarty->display('error.tpl');
	exit;
}
/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is error.php, released on 2003-02-21.

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

?>
